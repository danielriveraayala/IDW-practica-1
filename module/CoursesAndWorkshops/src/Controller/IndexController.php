<?php

namespace CoursesAndWorkshops\Controller;

use CoursesAndWorkshops\Entity\cursosYTalleres;
use CoursesAndWorkshops\Form\inscripcionForm;
use Doctrine\ORM\EntityManager;
use Laminas\Json\Json;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use Sample\PayPalClient;
use Users\Entity\User;

class IndexController extends AbstractActionController
{
    private $entityManager;
    private const brand_name = "www.soyfreelancer.dev";

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        return new ViewModel(['coursesAndWorkshops' => $this->getCursosFuturosActivos()]);
    }

    public function previewAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $coursesAndWorkshops = $this->entityManager->getRepository(cursosYTalleres::class)->findOneBy(['id' => $id, 'catEstatusPublicacionId' => 2]);
        if (!$coursesAndWorkshops) {
            return $this->redirect()->toRoute('CoursesAndWorkshops');
        } else {
            return new ViewModel(['coursesAndWorkshops' => $coursesAndWorkshops]);
        }
    }

    public function createOrderAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $debug = $this->params()->fromRoute('debug', false);
        /**@var $curso cursosYTalleres */
        $curso = $this->entityManager->getRepository(cursosYTalleres::class)->findOneBy(['id' => $id]);


        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = self::buildRequestBody($curso);

        $client = PayPalClient::client();
        $response = $client->execute($request);
        $debugRequest = [];
        if ($debug) {
            $debugRequest['Status Code'] = $response->statusCode;
            $debugRequest['Status'] = $response->result->status;
            $debugRequest['Order ID'] = $response->result->id;
            $debugRequest['Intent'] = $response->result->intent;
            return new JsonModel([$response, $debugRequest]);
        } else {
            return new JsonModel([$response]);
        }
    }

    public function captureOrderAction()
    {
        $orderId = $this->params()->fromRoute('orderID', 0);
        $request = new OrdersCaptureRequest($orderId);
        $client = PayPalClient::client();
        $response = $client->execute($request);
//        return new JsonModel([$response]);
        $this->redirect()->toRoute('CoursesAndWorkshops/createInscriptionOfCoursesAndWorkshops', [], null, true);
    }

    public function getOrderAction()
    {
        $messageTitle = 'Inscripción';
        $inscripcionesForm = new inscripcionForm();
        $aviso = '';
        /*Verificamos que llegue con un ID de Orden de Paypal*/
        if ($orderId = $this->params()->fromRoute('orderID', false)) {

            $isRegister = $this->verifyRegistrationByOrderIdPaypal($orderId);
            if (is_null($isRegister)) {
                if (!$this->getRequest()->isPost()) {
                    try {
                        $client = PayPalClient::client();
                        $response = $client->execute(new OrdersGetRequest($orderId));
                        $paypalData = [
                            'status_code' => $response->statusCode,
                            'result_status' => $response->result->status,
                            'order_id' => $response->result->id,
                            'reference_id' => (int)$response->result->purchase_units[0]->reference_id,
                            'custom_id' => $response->result->purchase_units[0]->custom_id,
                            'soft_descriptor' => $response->result->purchase_units[0]->soft_descriptor,
                            'nombre' => $response->result->payer->name->given_name,
                            'primer_apellido' => $response->result->payer->name->surname,
                            'email' => $response->result->payer->email_address,
                            'payer_id' => $response->result->payer->payer_id,
                        ];
                        $inscripcionesForm->setData($paypalData);
                        $aviso = 'Estatus de orden: ' . $paypalData['result_status'] . '. Confirma los datos sean correctos y finaliza la inscripción. Guarda tu ID de Orden para cualquier aclaración.';
                    } catch (\Exception $e) {
                        $result = Json::decode($e->getMessage());
                        if ($result->name === 'RESOURCE_NOT_FOUND') {
                            $this->flashMessenger()
                                ->addMessage(['icon' => 'warning', 'title' => $messageTitle, 'text' => 'El ID de Orden: ' . $orderId . ' no pertenece a una orden de Paypal']);
                            return $this->redirect()->toRoute('CoursesAndWorkshops');
                        }
                    }
                } else {
                    $data = $this->getRequest()->getPost();
                    $this->enrollStudent($inscripcionesForm, $data);
                }
            } else {
                $this->flashMessenger()
                    ->addMessage(['icon' => 'success', 'title' => $messageTitle, 'text' => 'El ID de Orden: ' . $orderId . ' ya se encuentra inscrito']);
                return $this->redirect()->toRoute('CoursesAndWorkshops');
            }

            return new ViewModel(['inscripcionesForm' => $inscripcionesForm->prepare(), 'aviso' => $aviso, 'curso' => $this->getCursosFuturosActivos(isset($paypalData['reference_id']) ? $paypalData['reference_id'] : $this->params()->fromPost('reference_id'))]);

        } else {
            $this->flashMessenger()
                ->addMessage(['icon' => 'warning', 'title' => $messageTitle, 'text' => 'No se proporciono ID de Orden']);
            return $this->redirect()->toRoute('CoursesAndWorkshops');
        }
    }

    public function getFreeOrderAction()
    {
        $inscripcionesForm = new inscripcionForm();
        if ($id = $this->params()->fromRoute('id', false)) {
            if (!$curso = $this->getCursosFuturosActivos($this->params()->fromRoute('id', 0))) {
                return $this->redirect()->toRoute('CoursesAndWorkshops');
            } else {
                if ((int)$curso->getCosto() !== 0) {
                    $this->flashMessenger()
                        ->addMessage(['icon' => 'warning', 'title' => $curso->getTitulo(), 'text' => 'Se requiere pago de inscripción']);
                    return $this->redirect()->toRoute('CoursesAndWorkshops');
                }
            }
        } else {
            return $this->redirect()->toRoute('CoursesAndWorkshops');
        }

        $messageTitle = 'Inscripción';
        $aviso = '';
        $inscripcionesForm->get('order_id')->setValue('NO REQUERIDO');
        $inscripcionesForm->get('reference_id')->setValue($id);

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $this->enrollStudent($inscripcionesForm, $data);
        }
        return new ViewModel(['inscripcionesForm' => $inscripcionesForm, 'curso' => $curso, 'aviso' => $aviso]);
    }

    private function verifyRegistrationByOrderIdPaypal($orderId)
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['orderId' => $orderId]);
    }

    private function verifyRegistrationByCurp($curp)
    {
        return $this->entityManager->getRepository(User::class)->findBy(['CURP' => $curp]);
    }

    private function enrollStudent($form, $data)
    {
        $proceedToRegistration = true;
        $existingStudent = $this->verifyRegistrationByCurp($data['curp']);
        $myCourses = [];
        if ($existingStudent) {
            foreach ($existingStudent as $existing) {
                if (!$existing->getInscripciones()->isEmpty()) {
                    foreach ($existing->getInscripciones() as $inscripcion) {
                        array_push($myCourses, $inscripcion->getId());
                    }
                }
            }
            $proceedToRegistration = !in_array($data['reference_id'], $myCourses);
        }
        $form->setData($data);
        $curso = $this->getCursosFuturosActivos($data['reference_id']);
        if ($form->isValid() && $proceedToRegistration) {
            $data = $form->getData();
            $user = new User();
            $user->setNombres($data['nombre']);
            $user->setPrimerApellido($data['primer_apellido']);
            $user->setSegundoApellido($data['segundo_apellido']);
            $user->setEmail($data['email']);
            $user->setCURP($data['curp']);
            $user->setPayerId(isset($data['payer_id']) ? $data['payer_id'] : null);
            $user->setStatusCode(isset($data['status_code']) ? $data['status_code'] : null);
            $user->setOrderId(isset($data['order_id']) ? $data['order_id'] : null);
            $user->setResultStatus(isset($data['result_status']) ? $data['result_status'] : null);
            $user->setCustomId(isset($data['custom_id']) ? $data['custom_id'] : null);
            $user->setSoftDescriptor(isset($data['soft_descriptor']) ? $data['soft_descriptor'] : null);
            $user->setInscripciones($curso);
            $user->setFechaRegistro(new \DateTime());
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $this->flashMessenger()
                ->addMessage(['icon' => 'success', 'title' => $curso->getTitulo(), 'text' => 'Te haz inscrito correctamente']);
            return $this->redirect()->toRoute('CoursesAndWorkshops');
        } elseif (!$proceedToRegistration) {
            $this->flashMessenger()
                ->addMessage(['icon' => 'info', 'title' => $curso->getTitulo(), 'text' => 'Ya se encuentra un alumno con esta CURP inscrito']);
            return $this->redirect()->refresh();
        }
    }

    /**
     * @param $curso
     *
     * @return array
     */
    private static function buildRequestBody($curso)
    {
        return [
            'intent' => 'CAPTURE',
            'application_context' =>
                [
                    'brand_name' => self::brand_name,
                    'locale' => 'es-MX',
                    'landing_page' => 'BILLING',
                    'user_action' => 'PAY_NOW',
                    'return_url' => 'https://example.com/return',
                    'cancel_url' => 'https://example.com/cancel'
                ],
            'purchase_units' =>
                [
                    0 =>
                        [
                            'reference_id' => $curso->getId(),
                            'custom_id' => strtoupper($curso->getCatTipoCursoTallerId()->getDescripcionTipoCursoTaller()) . '_ID-' . $curso->getID(),
                            'description' => $curso->getCatTipoCursoTallerId()->getDescripcionTipoCursoTaller() . ' "' . $curso->getTitulo() . '" impartido por MERGEN.',
                            'soft_descriptor' => strtoupper($curso->getCatTipoCursoTallerId()->getDescripcionTipoCursoTaller()),
                            'category' => 'GENERAL',
                            'amount' =>
                                [
                                    'currency_code' => 'MXN',
                                    'value' => $curso->getCosto(),
                                    'breakdown' => [
                                        'item_total' => [
                                            'currency_code' => 'MXN',
                                            'value' => $curso->getCosto(),
                                        ],
                                    ],
                                ],

                        ],
                ],
        ];
    }

    private function getCursosFuturosActivos($id = null)
    {
        $coursesAndWorkshops = $this->entityManager->createQueryBuilder()
            ->select('cursos')
            ->from(cursosYTalleres::class, 'cursos')
            ->where('cursos.catEstatusPublicacionId = :catEstatusPublicacionId')
            ->andWhere('cursos.fechaInicio >= :fechaInicio')
            ->setParameters([
                'catEstatusPublicacionId' => 2,
                'fechaInicio' => date('Y-m-d')
            ]);

        if (!is_null($id)) {
            return $coursesAndWorkshops->andWhere('cursos.id = :id')->setParameter(':id', $id)->getQuery()->getOneOrNullResult();
        } else {
            return $coursesAndWorkshops->getQuery()->getResult();
        }

    }
}