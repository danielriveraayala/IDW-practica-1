<?php


namespace CoursesAndWorkshops\Form;


use Doctrine\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Laminas\Form\Element;
use Laminas\Form\Form;

class addNewCourseOrWorkshopForm extends Form implements ObjectManagerAwareInterface
{
    protected $ObjectManager;

    public function __construct($ObjectManager)
    {
        $this->setObjectManager($ObjectManager);
        parent::__construct('addNewCourseOrWorkshop');
        $this->init();
    }

    public function init()
    {
        $this->add([
            'type' => ObjectSelect::class,
            'name' => 'cat_tipo_duracion_id',
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Tipo de duración</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
                'display_empty_item' => true,
                'empty_item_label' => 'Selecciona un opción',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'CoursesAndWorkshops\Entity\catTipoDuracion',
                'label_generator' => function ($targetEntity) {
                    return ucwords($targetEntity->getDescripcionTipoDuracion());
                },
            ],
            'attributes' => [
                'class' => 'form-control col',
                'id' => 'cat_tipo_duracion_id',
                'required' => true,
            ],
        ]);//cat_tipo_duracion
        $this->add([
            'type' => ObjectSelect::class,
            'name' => 'cat_tipo_registro_id',
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Tipo de inscripción</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
                'display_empty_item' => true,
                'empty_item_label' => 'Selecciona un opción',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'CoursesAndWorkshops\Entity\catTipoRegistro',
                'label_generator' => function ($targetEntity) {
                    return ucwords($targetEntity->getDescripcionTipoRegistro());
                },
            ],
            'attributes' => [
                'class' => 'form-control col',
                'id' => 'cat_tipo_registro_id',
                'required' => true,
            ],
        ]);//cat_tipo_registro
        $this->add([
            'type' => ObjectSelect::class,
            'name' => 'cat_modalidad_id',
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Modalidad</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
                'display_empty_item' => true,
                'empty_item_label' => 'Selecciona un opción',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'CoursesAndWorkshops\Entity\catModalidad',
                'label_generator' => function ($targetEntity) {
                    return ucwords($targetEntity->getDescripcionModalidad());
                },
            ],
            'attributes' => [
                'class' => 'form-control col',
                'id' => 'cat_modalidad_id',
                'required' => true,
            ],
        ]);//cat_modalidad_id
        $this->add([
            'type' => ObjectSelect::class,
            'name' => 'cat_estatus_publicacion_id',
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Estatus de publicación</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
                'display_empty_item' => true,
                'empty_item_label' => 'Selecciona un opción',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'CoursesAndWorkshops\Entity\catEstatusPublicacion',
                'label_generator' => function ($targetEntity) {
                    return ucwords($targetEntity->getDescripcionEstatusPublicacion());
                },
            ],
            'attributes' => [
                'class' => 'form-control col',
                'id' => 'cat_estatus_publicacion_id',
                'required' => true,
            ],
        ]);//cat_tipo_duracion
        $this->add([
            'type' => ObjectSelect::class,
            'name' => 'cat_tipo_curso_taller_id',
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Tipo de actvidad</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
                'display_empty_item' => true,
                'empty_item_label' => 'Selecciona un opción',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'CoursesAndWorkshops\Entity\catTipoCursoTaller',
                'label_generator' => function ($targetEntity) {
                    return ucwords($targetEntity->getDescripcionTipoCursoTaller());
                },
            ],
            'attributes' => [
                'class' => 'form-control col',
                'id' => 'cat_tipo_curso_taller_id',
                'required' => true,
            ],
        ]);//cat_tipo_curso_taller
        $this->add([
            'type' => Element\Text::class,
            'name' => 'titulo',
            'attributes' => [
                'required' => true,
                'id' => 'titulo',
                'class' => 'form-control text-capitalize',
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Titulo</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'subtitulo',
            'attributes' => [
                'required' => false,
                'id' => 'subtitulo',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Subtitulo',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'introduccion',
            'attributes' => [
                'required' => false,
                'id' => 'introduccion',
                'class' => 'summernote',
                'min' => 1
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Introduccion</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Date::class,
            'name' => 'fecha_inicio',
            'attributes' => [
                'required' => true,
                'id' => 'fecha_inicio',
//                'min' => date('Y-m-d'),
                'class' => 'form-control text-capitalize',
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Fecha de Inicio</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'hora_inicio',
            'attributes' => [
                'required' => false,
                'id' => 'hora_inicio',
                'data-target'=>'#hora_inicio_',
                'class' => 'form-control datetimepicker-input',
            ],
            'options' => [
                'label' => 'Hora de Inicio',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Date::class,
            'name' => 'fecha_termino',
            'attributes' => [
                'required' => true,
                'id' => 'fecha_termino',
//                'min' => date('Y-m-d'),
                'class' => 'form-control text-capitalize',
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Fecha de Termino</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'hora_termino',
            'attributes' => [
                'required' => false,
                'id' => 'hora_termino',
                'data-target'=>'#hora_termino_',
                'class' => 'form-control datetimepicker-input',
            ],
            'options' => [
                'label' => 'Hora de termino',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Number::class,
            'name' => 'costo',
            'attributes' => [
                'required' => true,
                'id' => 'costo',
                'value' => 0,
                'min' => 0,
                'class' => 'form-control text-capitalize',
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Costo</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Number::class,
            'name' => 'num_min_integrantes',
            'attributes' => [
                'required' => true,
                'id' => 'num_min_integrantes',
                'class' => 'form-control text-capitalize',
                'min' => 1,
                'value' => 1,
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Min. de Integrantes</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Number::class,
            'name' => 'num_max_integrantes',
            'attributes' => [
                'required' => true,
                'id' => 'num_max_integrantes',
                'class' => 'form-control text-capitalize',
                'min' => 1,
                'value' => 1,
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Max. de Integrantes</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Checkbox::class,
            'name' => 'si_constancia',
            'attributes' => [
                'id' => 'si_constancia',
                'required' => false,
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>¿Habrá constancia de participación?</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Number::class,
            'name' => 'duracion',
            'attributes' => [
                'required' => true,
                'id' => 'duracion',
                'class' => 'form-control text-capitalize',
                'min' => 1
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Duración</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'ponentes',
            'attributes' => [
                'required' => true,
                'id' => 'ponentes',
                'class' => 'form-control text-capitalize',
                'min' => 1
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Ponentes</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'domicilio',
            'attributes' => [
                'required' => false,
                'id' => 'domicilio',
                'class' => 'form-control text-capitalize',
                'min' => 1
            ],
            'options' => [
                'label' => 'Domicilio',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'contactos',
            'attributes' => [
                'required' => false,
                'id' => 'contactos',
                'class' => 'summernote',
                'min' => 1
            ],
            'options' => [
                'label' => 'Información de contacto adicional',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'programa',
            'attributes' => [
                'required' => false,
                'id' => 'programa',
                'class' => 'summernote',
                'min' => 1
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Programa</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'convenio',
            'attributes' => [
                'required' => false,
                'id' => 'convenio',
                'class' => 'summernote',
                'min' => 1
            ],
            'options' => [
                'label' => 'Convenios de coolaboración',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'palabras_clave',
            'attributes' => [
                'required' => false,
                'id' => 'palabras_clave',
                'class' => 'form-control',
                'min' => 1,
                'data-role' => 'tagsinput'
            ],
            'options' => [
                'label' => 'Palabras clave',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'link_externo',
            'attributes' => [
                'required' => false,
                'id' => 'link_externo',
                'class' => 'form-control',
                'min' => 1,
            ],
            'options' => [
                'label' => 'Link externo',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'dirigido_a',
            'attributes' => [
                'required' => false,
                'id' => 'dirigido_a',
                'class' => 'form-control',
                'min' => 1,
            ],
            'options' => [
                'label' => 'Dirigido a',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Element\Button::class,
            'options' => [
                'label' => '<i class="fas fa-save"></i> <b>Guardar</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ]
            ],
            'attributes' => [
                'value' => '0',
                'type' => 'submit',
                'class' => 'btn btn-primary',//
            ],
        ]);
        parent::init();
    }

    /**
     * @inheritDoc
     */
    public function setObjectManager(ObjectManager $objectManager): void
    {
        $this->ObjectManager = $objectManager;
    }

    /**
     * @inheritDoc
     */
    public function getObjectManager(): ObjectManager
    {
        return $this->ObjectManager;
    }
}