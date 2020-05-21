<?php


namespace Dashboard;


use Laminas\Form\Element\Button;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class albumForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('album-form', $options);
        $this->add([
            'type' => Text::class,
            'name' => 'artist',
            'attributes' => [
                'required' => true,
                'class' => 'form-control text-capitalize'
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Artista</b>',
                'label_options' => [
                    'disable_html_escape' => true
                ]
            ]
        ]);
        $this->add([
            'type' => Text::class,
            'name' => 'title',
            'attributes' => [
                'required' => true,
                'class' => 'form-control text-capitalize'
            ],
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Titulo de la canción</b>',
                'label_options' => [
                    'disable_html_escape' => true
                ]
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Button::class,
            'options' => [
                'label' => '<i class="fas fa-save"></i> <b>Guardar</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ]
            ],
            'attributes' => [
                'type' => 'submit',
                'class' => 'btn btn-primary float-right',
            ],
        ]);//submit
    }
}