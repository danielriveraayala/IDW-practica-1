<?php


namespace Dashboard\Controller\Factory;


use Dashboard\albumForm;
use Dashboard\Controller\AlbumController;
use Interop\Container\ContainerInterface;

class AlbumControllerFactory implements \Laminas\ServiceManager\Factory\FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $formElementManager = $container->get('FormElementManager');
        $albumForm = $formElementManager->get(albumForm::class);
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $editAlbumSession = $container->get('editAlbum');
        return new AlbumController($entityManager, $albumForm, $editAlbumSession);
    }
}