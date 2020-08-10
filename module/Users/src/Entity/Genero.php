<?php
/**
 * Copyright (c) 2019. @author Desarrollo hecho por danielriveraayala@gmail.com
 */

namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="cat_genero")
 */
class Genero
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id",type="integer",nullable=false)
     */
    protected $id;

    /**
     * @ORM\Column(name="descripcion_genero",type="string",nullable=false)
     */
    protected $descripcionGenero;

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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescripcionGenero()
    {
        return $this->descripcionGenero;
    }

    /**
     * @param mixed $descripcionSexo
     */
    public function setDescripcionGenero($descripcionGenero)
    {
        $this->descripcionGenero = $descripcionGenero;
    }

}
