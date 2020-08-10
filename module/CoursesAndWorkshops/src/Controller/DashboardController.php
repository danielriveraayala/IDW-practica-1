<?php


    namespace CoursesAndWorkshops\Controller;


    use CoursesAndWorkshops\Entity\catEstatusPublicacion;
    use CoursesAndWorkshops\Entity\catModalidad;
    use CoursesAndWorkshops\Entity\catTipoCursoTaller;
    use CoursesAndWorkshops\Entity\catTipoDuracion;
    use CoursesAndWorkshops\Entity\catTipoRegistro;
    use CoursesAndWorkshops\Entity\cursosYTalleres;
    use CoursesAndWorkshops\Form\addNewCourseOrWorkshopForm;
    use Doctrine\ORM\EntityManager;
    use Laminas\Json\Json;
    use Laminas\Mvc\Controller\AbstractActionController;
    use Laminas\Mvc\MvcEvent;
    use Laminas\View\Model\JsonModel;
    use Laminas\View\Model\ViewModel;
    use PayPalCheckoutSdk\Orders\OrdersGetRequest;
    use Sample\PayPalClient;

    class DashboardController extends AbstractActionController
    {
        private $entityManager;

        public function __construct(EntityManager $entityManager)
        {
            $this->entityManager = $entityManager;
        }

        public function onDispatch(MvcEvent $e)
        {
            $response = parent::onDispatch($e);
            $this->layout()->setTemplate('partial/layout');
            return $response;
        }

        public function registrationAndEditingAction()
        {
            $addNewCourseOrWorkshopForm = new addNewCourseOrWorkshopForm($this->entityManager);
            $id = $this->params()->fromRoute('id', 0);
            /**
             * @var $cursos_y_talleres cursosYTalleres
             */
            if ($cursos_y_talleres = $this->entityManager->getRepository(cursosYTalleres::class)->findOneBy(['id' => $id])) {
                $data = [
                    'titulo' => $cursos_y_talleres->getTitulo(),
                    'subtitulo' => $cursos_y_talleres->getSubtitulo(),
                    'introduccion' => $cursos_y_talleres->getIntroduccion(),
                    'fecha_inicio' => $cursos_y_talleres->getFechaInicio()->format('Y-m-d'),
                    'hora_inicio' => $cursos_y_talleres->getHoraInicio(),
                    'fecha_termino' => $cursos_y_talleres->getFechaTermino()->format('Y-m-d'),
                    'hora_termino' => $cursos_y_talleres->getHoraTermino(),
                    'num_min_integrantes' => $cursos_y_talleres->getNumMinIntegrantes(),
                    'num_max_integrantes' => $cursos_y_talleres->getNumMaxIntegrantes(),
                    'cat_tipo_duracion_id' => $cursos_y_talleres->getCatTipoDuracionId()->getId(),
                    'duracion' => $cursos_y_talleres->getDuracion(),
                    'cat_tipo_registro_id' => $cursos_y_talleres->getCatTipoRegistroId()->getId(),
                    'cat_modalidad_id' => $cursos_y_talleres->getCatModalidadId()->getId(),
                    'costo' => $cursos_y_talleres->getCosto(),
                    'ponentes' => $cursos_y_talleres->getPonentes(),
                    'domicilio' => $cursos_y_talleres->getDomicilio(),
                    'contactos' => $cursos_y_talleres->getContactos(),
                    'programa' => $cursos_y_talleres->getPrograma(),
                    'convenio' => $cursos_y_talleres->getConvenio(),
                    'palabras_clave' => $cursos_y_talleres->getPalabrasClave(),
                    'si_constancia' => $cursos_y_talleres->getSiConstancia(),
                    'link_externo' => $cursos_y_talleres->getLinkExterno(),
                    'dirigido_a' => $cursos_y_talleres->getDirigidoA(),
                    'cat_estatus_publicacion_id' => $cursos_y_talleres->getCatEstatusPublicacionId()->getId(),
                    'cat_tipo_curso_taller_id' => $cursos_y_talleres->getCatTipoCursoTallerId()->getId()
                ];
                $addNewCourseOrWorkshopForm->setData($data);
            }
            if ($this->getRequest()->isPost()) {
                $data = $this->getRequest()->getPost();
                $addNewCourseOrWorkshopForm->setData($data);
                if ($addNewCourseOrWorkshopForm->isValid()) {
                    $data = $addNewCourseOrWorkshopForm->getData();
                    if (!$cursos_y_talleres) {
                        $id = $this->IO($data);
                        $this->flashMessenger()
                            ->addMessage(['icon' => 'success', 'title' => 'Registro de curso o taller', 'text' => '¡Los datos se han registrado con exito!']);
                        $this->redirect()->toRoute('coursesAndWorkshopsDashboardAccess/coursesAndWorkshops', ['action' => 'registrationAndEditing', 'id' => $id]);
                    } else {
                        $this->IO($data, $cursos_y_talleres);
                        $this->flashMessenger()
                            ->addMessage(['icon' => 'success', 'title' => 'Actualización de curso o taller', 'text' => '¡Los cambios se han guardado correctamente!']);
                        $this->redirect()->refresh();
                    }
                }
            }
            return new ViewModel(['addNewCourseOrWorkshopForm' => $addNewCourseOrWorkshopForm->prepare()]);

        }

        public function listOfCoursesAndWorkshopsAction()
        {
            /**
             * @var $list cursosYTalleres
             */
            if ($this->getRequest()->isXmlHttpRequest()) {
                if ($this->getRequest()->isPost()) {
                    $id = $this->params()->fromPost('id', 0);
                    $estatusId = $this->params()->fromPost('estatus', 0);
                    $estatus = $this->entityManager->getRepository(catEstatusPublicacion::class)->findOneBy(['id' => $estatusId]);
                    /**
                     * @var $rowToUpdate cursosYTalleres
                     */
                    $rowToUpdate = $this->entityManager->getRepository(cursosYTalleres::class)->findOneBy(['id' => $id]);
                    $rowToUpdate->setCatEstatusPublicacionId($estatus);
                    $this->entityManager->flush();
                    return new JsonModel(['icon' => $estatus->getIconType(), 'title' => 'Estatus cambiado', 'text' => 'Publicación: ' . $estatus->getDescripcionEstatusPublicacion()]);
                } else {
                    $list = $this->entityManager->createQueryBuilder()
                        ->select('cursos')
                        ->addSelect('cep')
                        ->from(cursosYTalleres::class, 'cursos')
                        ->innerJoin('cursos.catEstatusPublicacionId', 'cep')
                        ->orderBy('cursos.fechaInicio', 'ASC')
                        ->getQuery()->getArrayResult();
                    $catEstatusPublicacion = $this->entityManager->getRepository(catEstatusPublicacion::class)->findAll();
                    foreach ($list as $key => $item) {
                        $list[$key]['fechaInicio'] = $item['fechaInicio']->format('Y-m-d');
                        $list[$key]['fechaTermino'] = $item['fechaTermino']->format('Y-m-d');
                        switch ($item['catEstatusPublicacionId']['id']) {
                            case 1:
                                $list[$key]['estatus'] = '<i class="fa fa-bookmark text-info"></i>';
                                break;
                            case 2:
                                $list[$key]['estatus'] = '<i class="fa fa-bookmark text-success"></i>';
                                break;
                            case 3:
                                $list[$key]['estatus'] = '<i class="fa fa-bookmark text-warning"></i>';
                                break;
                        }
                        $options = '';
                        foreach ($catEstatusPublicacion as $status) {
                            $selected = $status->getId() === $item['catEstatusPublicacionId']['id'] ? 'selected' : '';
                            $options .= '<option value="' . $status->getId() . '" ' . $selected . ' >' . $status->getDescripcionEstatusPublicacion() . '</option>';
                        }
                        $list[$key]['catEstatusPublicacionId'] = '<select onChange="changeStatus($(this),\'' . $this->url()->fromRoute('coursesAndWorkshopsDashboardAccess/coursesAndWorkshops', ['action' => 'listOfCoursesAndWorkshops']) . '\')" class="w-100" data-id="' . $item['id'] . '">' . $options . '</select>';
                        $list[$key]['preview'] = '<a href="' . $this->url()->fromRoute('coursesAndWorkshopsDashboardAccess/coursesAndWorkshops', ['action' => 'registrationAndEditing', 'id' => $item['id']]) . '"><i class="fa fa-link"></i></a>';
                    }
                    return new JsonModel($list);
                }
            }
            return new ViewModel();
        }

        private function IO($data, $cursos_y_talleres = null)
        {
            $cursos_y_talleres = is_null($cursos_y_talleres) ? new cursosYTalleres() : $cursos_y_talleres;
            $cursos_y_talleres->setCatTipoDuracionId(
                $this->entityManager->getRepository(catTipoDuracion::class)->findOneBy(['id' => $data['cat_tipo_duracion_id']])
            );
            $cursos_y_talleres->setCatTipoRegistroId(
                $this->entityManager->getRepository(catTipoRegistro::class)->findOneBy(['id' => $data['cat_tipo_registro_id']])
            );
            $cursos_y_talleres->setCatModalidadId(
                $this->entityManager->getRepository(catModalidad::class)->findOneBy(['id' => $data['cat_modalidad_id']])
            );
            $cursos_y_talleres->setCatTipoCursoTallerId(
                $this->entityManager->getRepository(catTipoCursoTaller::class)->findOneBy(['id' => $data['cat_tipo_curso_taller_id']])
            );
            $cursos_y_talleres->setTitulo($data['titulo']);
            $cursos_y_talleres->setSubtitulo($data['subtitulo'] !== '' ? $data['subtitulo'] : null);
            $cursos_y_talleres->setIntroduccion($data['introduccion'] !== '' ? $data['introduccion'] : null);
            $cursos_y_talleres->setFechaInicio(new \DateTime($data['fecha_inicio']));
            $cursos_y_talleres->setHoraInicio($data['hora_inicio'] !== '' ? $data['hora_inicio'] : null);
            $cursos_y_talleres->setHoraTermino($data['hora_termino'] !== '' ? $data['hora_termino'] : null);
            $cursos_y_talleres->setFechaTermino(new \DateTime($data['fecha_termino']));
            $cursos_y_talleres->setCosto($data['costo']);
            $cursos_y_talleres->setNumMinIntegrantes($data['num_min_integrantes']);
            $cursos_y_talleres->setNumMaxIntegrantes($data['num_max_integrantes']);
            $cursos_y_talleres->setSiConstancia($data['si_constancia']);
            $cursos_y_talleres->setPonentes($data['ponentes']);
            $cursos_y_talleres->setDuracion($data['duracion']);
            $cursos_y_talleres->setDomicilio($data['domicilio'] !== '' ? $data['domicilio'] : null);
            $cursos_y_talleres->setContactos($data['contactos'] !== '' ? $data['contactos'] : null);
            $cursos_y_talleres->setPrograma($data['programa']);
            $cursos_y_talleres->setConvenio($data['convenio'] !== '' ? $data['convenio'] : null);
            $cursos_y_talleres->setPalabrasClave($data['palabras_clave'] !== '' ? $data['palabras_clave'] : null);
            $cursos_y_talleres->setCatEstatusPublicacionId(
                $this->entityManager->getRepository(catEstatusPublicacion::class)->findOneBy(['id' => $data['cat_estatus_publicacion_id']])
            );
            $cursos_y_talleres->setLinkExterno($data['link_externo'] !== '' ? $data['link_externo'] : null);
            $cursos_y_talleres->setDirigidoA($data['dirigido_a'] !== '' ? $data['dirigido_a'] : null);
            $this->entityManager->persist($cursos_y_talleres);
            $this->entityManager->flush();
            if (!is_null($cursos_y_talleres->getId()))
                return $cursos_y_talleres->getId(); else return false;
        }

        public function inscriptionsAction()
        {
            $coursesAndWorkshops = $this->entityManager->createQueryBuilder()
                ->select('cursos')
                ->from(cursosYTalleres::class, 'cursos')
                ->where('cursos.catEstatusPublicacionId = :catEstatusPublicacionId')
                ->setParameters([
                    'catEstatusPublicacionId' => 2,
                ])->getQuery()->getResult();

            return new ViewModel(['coursesAndWorkshops' => $coursesAndWorkshops]);
        }

        public function checkOrderAction()
        {
            $orderId = $this->params()->fromRoute('id', false);
            if (!$orderId) {
                $this->redirect()->toRoute('coursesAndWorkshopsDashboardAccess/coursesAndWorkshops', ['action' => 'inscriptions']);
            } else {
                try {
                    $client = PayPalClient::client();
                    $response = $client->execute(new OrdersGetRequest($orderId));
                    $paypalData = [
                        'result_status' => $response->result->status,
                        'order_id' => $response->result->id,
                        'reference_id' => (int)$response->result->purchase_units[0]->reference_id,
                        'custom_id' => $response->result->purchase_units[0]->custom_id,
                        'soft_descriptor' => $response->result->purchase_units[0]->soft_descriptor,
                        'nombre' => $response->result->payer->name->given_name,
                        'primer_apellido' => $response->result->payer->name->surname,
                        'payer_email' => $response->result->payer->email_address,
                        'payer_id' => $response->result->payer->payer_id,
                        'currency_code' => $response->result->purchase_units[0]->amount->currency_code,
                        'value' => $response->result->purchase_units[0]->amount->value,
                        'payee_email_address' => $response->result->purchase_units[0]->payee->email_address,
                        'payee_merchant_id' => $response->result->purchase_units[0]->payee->merchant_id,
                        'description' => $response->result->purchase_units[0]->description
                    ];
                    /*print_r('<pre style="margin-left: 300px">');
                    var_export($paypalData);
                    print_r('</pre>');*/
                } catch (\Exception $e) {
                    $result = Json::decode($e->getMessage());
                    if ($result->name === 'RESOURCE_NOT_FOUND') {
                        $this->flashMessenger()
                            ->addMessage(['icon' => 'warning', 'title' => 'Comprobación de orden', 'text' => 'El ID de Orden: ' . $orderId . ' no pertenece a una orden de Paypal']);
                        return $this->redirect()->toRoute('coursesAndWorkshopsDashboardAccess/coursesAndWorkshops', ['action' => 'inscriptions']);
                    }
                }
            }
            return new ViewModel(['paypalData' => $paypalData]);
        }
    }