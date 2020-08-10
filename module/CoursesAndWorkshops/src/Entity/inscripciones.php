<?php


namespace CoursesAndWorkshops\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="inscripciones")
 */
class inscripciones
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Users\Entity\User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    protected $userId;
    /**
     * @ORM\ManyToOne(targetEntity="CoursesAndWorkshops\Entity\cursosYTalleres")
     * @ORM\JoinColumn(name="cursos_id",referencedColumnName="id")
     */
    protected $cursosID;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCursosYTalleresId()
    {
        return $this->cursosYTalleresId;
    }

    /**
     * @param mixed $cursosYTalleresId
     */
    public function setCursosYTalleresId($cursosYTalleresId): void
    {
        $this->cursosYTalleresId = $cursosYTalleresId;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return mixed
     */
    public function getResultId()
    {
        return $this->resultId;
    }

    /**
     * @param mixed $resultId
     */
    public function setResultId($resultId): void
    {
        $this->resultId = $resultId;
    }

    /**
     * @return mixed
     */
    public function getResultStatus()
    {
        return $this->resultStatus;
    }

    /**
     * @param mixed $resultStatus
     */
    public function setResultStatus($resultStatus): void
    {
        $this->resultStatus = $resultStatus;
    }

    /**
     * @return mixed
     */
    public function getCustomId()
    {
        return $this->customId;
    }

    /**
     * @param mixed $customId
     */
    public function setCustomId($customId): void
    {
        $this->customId = $customId;
    }

    /**
     * @return mixed
     */
    public function getSoftDescriptor()
    {
        return $this->softDescriptor;
    }

    /**
     * @param mixed $softDescriptor
     */
    public function setSoftDescriptor($softDescriptor): void
    {
        $this->softDescriptor = $softDescriptor;
    }


}