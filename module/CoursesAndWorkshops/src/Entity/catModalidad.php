<?php


namespace CoursesAndWorkshops\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cat_modalidad")
 */
class catModalidad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(name="descripcion_modalidad",type="string")
     */
    protected $descripcionModalidad;

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
    public function getDescripcionModalidad()
    {
        return $this->descripcionModalidad;
    }

    /**
     * @param mixed $descripcionModalidad
     */
    public function setDescripcionModalidad($descripcionModalidad): void
    {
        $this->descripcionModalidad = $descripcionModalidad;
    }


}