<?php


namespace CoursesAndWorkshops\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cat_estatus_publicacion")
 */
class catEstatusPublicacion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(name="descripcion_estatus_publicacion",type="string",nullable=false,length=255)
     */
    protected $descripcionEstatusPublicacion;
    /**
     * @ORM\Column(name="icon_type",type="string",nullable=true,length=20)
     */
    protected $iconType;

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
    public function getDescripcionEstatusPublicacion()
    {
        return $this->descripcionEstatusPublicacion;
    }

    /**
     * @param mixed $descripcionEstatusPublicacion
     */
    public function setDescripcionEstatusPublicacion($descripcionEstatusPublicacion): void
    {
        $this->descripcionEstatusPublicacion = $descripcionEstatusPublicacion;
    }

    /**
     * @return mixed
     */
    public function getIconType()
    {
        return $this->iconType;
    }

    /**
     * @param mixed $iconType
     */
    public function setIconType($iconType): void
    {
        $this->iconType = $iconType;
    }

}