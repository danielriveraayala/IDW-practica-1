<?php


namespace CoursesAndWorkshops\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cat_tipo_duracion")
 */
class catTipoDuracion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(name="descripcion_tipo_duracion",type="string")
     */
    protected $descripcionTipoDuracion;

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
    public function getDescripcionTipoDuracion()
    {
        return $this->descripcionTipoDuracion;
    }

    /**
     * @param mixed $descripcionTipoDuracion
     */
    public function setDescripcionTipoDuracion($descripcionTipoDuracion): void
    {
        $this->descripcionTipoDuracion = $descripcionTipoDuracion;
    }



}