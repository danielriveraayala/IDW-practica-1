<?php

declare(strict_types=1);

namespace Dashboard\Controller;


use Dashboard\Entity\album;
use Dashboard\Form\albumForm;
use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Laminas\View\Model\ViewModel;

/**
 * Class AlbumController
 *
 * @package Dashboard\Controller
 */
class AlbumController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var albumForm
     */
    protected $albumForm;
    /**
     * @var
     */
    protected $editAlbumSession;

    /**
     * AlbumController constructor.
     *
     * @param           $entityManager
     * @param albumForm $albumForm
     */
    public function __construct($entityManager, $editAlbumSession, $albumForm)
    {
        $this->entityManager = $entityManager;
        $this->albumForm = $albumForm;
        $this->editAlbumSession = $editAlbumSession;
    }


    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        /**
         * @var album $album
         */
        $album = $this->entityManager->getRepository(album::class)->findAll();
        return new ViewModel(['album' => $album]);
    }

    /**
     * @return ViewModel
     */
    public function addAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $this->albumForm->setData($data);
            if ($this->albumForm->isValid()) {
                $data = $this->params()->fromPost();
                $this->entityManager->beginTransaction();
                $album = new album();
                $album->setArtist($data['artist']);
                $album->setTitle($data['title']);
                $this->entityManager->persist($album);
                $this->entityManager->flush();
                if (is_null($album->getId())) {
                    $this->entityManager->rollback();
                } else {
                    $this->flashMessenger()->addMessage('Canción agregada con exito!', FlashMessenger::NAMESPACE_SUCCESS);
                    $this->entityManager->commit();
                }
                $this->redirect()->toRoute('dashboard/album');
            }
        }
        return new ViewModel(['form' => $this->albumForm->prepare()]);
    }

    /**
     * @return ViewModel
     */
    public function editAction()
    {
        if ($idToEdit = $this->params()->fromRoute('id', false)) {
            $this->editAlbumSession->id = $idToEdit;
            $this->redirect()->toRoute('dashboard/album', ['action' => 'edit']);
        }
        $this->albumForm->get('submit')->setLabel('Actualizar');
        /**
         * @var album $rowToEdit
         */
        $rowToEdit = $this->entityManager->getRepository(album::class)->findOneBy(['id' => $this->editAlbumSession->id]);
        if (is_null($rowToEdit))
            $this->redirect()->toRoute('dashboard/album');
        $data = [
            'artist' => $rowToEdit->getArtist(),
            'title' => $rowToEdit->getTitle()
        ];
        $this->albumForm->setData($data);
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $this->albumForm->setData($data);
            if ($this->albumForm->isValid()) {
                $rowToEdit->setTitle($data['title']);
                $rowToEdit->setArtist($data['artist']);
                $this->entityManager->flush();
                $this->flashMessenger()->addMessage('Canción agregada con exito!', FlashMessenger::NAMESPACE_SUCCESS);
                $this->redirect()->refresh();
            }
        }

        return new ViewModel(['form' => $this->albumForm->prepare()]);
    }

    /**
     * @return ViewModel
     */
    public function deleteAction()
    {
        if ($idToDelete = $this->params()->fromRoute('id', false)) {
            $this->editAlbumSession->id = $idToDelete;
            $this->redirect()->toRoute('dashboard/album', ['action' => 'delete']);
        }
        /**
         * @var album $rowToDelete
         */
        $rowToDelete = $this->entityManager->getRepository(album::class)->findOneBy(['id' => $this->editAlbumSession->id]);
        if ($this->params()->fromQuery('deleteRow', '') == 'yes') {
            $this->entityManager->remove($rowToDelete);
            $this->entityManager->flush();
            $this->flashMessenger()->addMessage('La cancion se elimino de la colección', FlashMessenger::NAMESPACE_SUCCESS);
            $this->redirect()->toRoute('dashboard/album');
        }
        return new ViewModel(['rowToDelete' => $rowToDelete]);
    }
}