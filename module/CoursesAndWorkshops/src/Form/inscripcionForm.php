<?php


namespace CoursesAndWorkshops\Form;


use Laminas\Form\Element;

class inscripcionForm extends \Laminas\Form\Form
{
    function __construct($name = 'inscripciones-form', $options = [])
    {
        parent::__construct($name, $options);
        $this->init();
    }

    public function init()
    {
        $this->add([
            'type' => Element\Text::class,
            'name' => 'order_id',
            'attributes' => [
                'required' => false,
                'id' => 'order_id',
                'readonly' => true,
                'class' => 'form-control text-capitalize',
            ],
            'options' => [
                'label' => 'ID de Orden',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'nombre',
            'attributes' => [
                'required' => true,
                'id' => 'nombre',
                'class' => 'form-control text-capitalize',
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Nombre</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'primer_apellido',
            'attributes' => [
                'required' => true,
                'id' => 'primer_apellido',
                'class' => 'form-control text-capitalize',
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Primer Apellido</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'segundo_apellido',
            'attributes' => [
                'required' => false,
                'id' => 'segundo_apellido',
                'class' => 'form-control text-capitalize',
            ],
            'options' => [
                'label' => 'Segundo Apellido',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Text::class,
            'name' => 'curp',
            'attributes' => [
                'required' => true,
                'id' => 'curp',
                'class' => 'form-control text-uppercase',
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>CURP</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Email::class,
            'name' => 'email',
            'attributes' => [
                'required' => true,
                'id' => 'email',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Email</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
            ],
        ]);
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'payer_id',
            'attributes' => [
                'required' => true,
                'id' => 'payer_id',
            ]
        ]);
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'status_code',
            'attributes' => [
                'required' => true,
                'id' => 'status_code',
            ]
        ]);
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'result_status',
            'attributes' => [
                'required' => true,
                'id' => 'result_status',
            ]
        ]);
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'reference_id',
            'attributes' => [
                'required' => true,
                'id' => 'reference_id',
            ]
        ]);
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'custom_id',
            'attributes' => [
                'required' => true,
                'id' => 'custom_id',
            ]
        ]);
        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'soft_descriptor',
            'attributes' => [
                'required' => true,
                'id' => 'soft_descriptor',
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Element\Button::class,
            'options' => [
                'label' => '<i class="fas fa-save"></i> <b class="text-white">Inscribirme</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ]
            ],
            'attributes' => [
//                'data-sitekey' => "6LdfWrwZAAAAAGSrleX682E0drEupjtjBE7a96bb",
//                'data-callback' => 'onSubmit',
//                'data-action' => 'submit',
                'type' => 'submit',
                'class' => 'g-recaptcha btn btn-primary',
            ],
        ]);

        parent::init();
    }
}