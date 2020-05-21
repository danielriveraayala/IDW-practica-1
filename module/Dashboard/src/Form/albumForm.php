<?php


namespace Dashboard\Form;


use Doctrine\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectSelect;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class albumForm extends Form implements ObjectManagerAwareInterface
{
    protected $objectManager;

    public function __construct($entityManager)
    {
        $this->setObjectManager($entityManager);
        parent::__construct('album-form');
        $this->setAttribute('method','post');
        $this->init();

    }

    public function init()
    {
        $this->add([
            'type' => ObjectSelect::class,
            'name' => 'genero_id',
            'options' => [
                'label' => '<i class="fas fa-asterisk"></i> <b>Genero de la canción</b>',
                'label_options' => [
                    'disable_html_escape' => true,
                ],
                'display_empty_item' => true,
                'empty_item_label' => 'Selecciona un cruza',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Dashboard\Entity\generos',
                'label_generator' => function ($targetEntity) {
                    return $targetEntity->getGenero();
                },
                'is_method' => true,
            ],
            'attributes' => [
                'class' => 'form-control',
                'id' => 'genero_id',
                'required' => true,
            ],
        ]);
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
        parent::init();
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function setObjectManager(ObjectManager $objectManager): void
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @return ObjectManager
     */
    public function getObjectManager(): ObjectManager
    {
        return $this->objectManager;
    }
}