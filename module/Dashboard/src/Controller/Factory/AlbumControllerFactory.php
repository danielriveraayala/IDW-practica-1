<?php


namespace Dashboard\Controller\Factory;


use Dashboard\Controller\AlbumController;
use Dashboard\Form\albumForm;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AlbumControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formElementManager = $container->get('FormElementManager');
        $albumForm = $formElementManager->get(albumForm::class);
        $editAlbumSession = $container->get('editAlbum');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new AlbumController($entityManager, $editAlbumSession, $albumForm);
    }
}