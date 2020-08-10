<?php


namespace CoursesAndWorkshops\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cat_tipo_registro")
 */
class catTipoRegistro
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(name="descripcion_tipo_registro",type="string")
     */
    protected $descripcionTipoRegistro;

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
    public function getDescripcionTipoRegistro()
    {
        return $this->descripcionTipoRegistro;
    }

    /**
     * @param mixed $descripcionTipoRegistro
     */
    public function setDescripcionTipoRegistro($descripcionTipoRegistro): void
    {
        $this->descripcionTipoRegistro = $descripcionTipoRegistro;
    }


}