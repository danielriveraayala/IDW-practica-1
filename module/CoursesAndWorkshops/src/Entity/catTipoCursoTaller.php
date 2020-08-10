<?php


namespace CoursesAndWorkshops\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cat_tipo_curso_taller")
 */
class catTipoCursoTaller
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */protected $id;
    /**
     * @ORM\Column(name="descripcion_tipo_curso_taller",type="string",nullable=false,length=255)
     */protected $descripcionTipoCursoTaller;

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
    public function getDescripcionTipoCursoTaller()
    {
        return $this->descripcionTipoCursoTaller;
    }

    /**
     * @param mixed $descripcionTipoCursoTaller
     */
    public function setDescripcionTipoCursoTaller($descripcionTipoCursoTaller): void
    {
        $this->descripcionTipoCursoTaller = $descripcionTipoCursoTaller;
    }


}