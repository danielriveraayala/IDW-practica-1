<?php
/**
 * Copyright (c) 2019. @author Desarrollo hecho por danielriveraayala@gmail.com
 */

namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cat_estado_rep_mex")
 */
class catEstadoRepMex
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="descripcion_estado", type="string")
     */
    protected $descripcionEstado;


    /**
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    function getDescripcionEstado()
    {
        return $this->descripcionEstado;
    }

    /**
     * @param $descripcionEstado
     */
    function setDescripcionEstado($descripcionEstado)
    {
        $this->descripcionEstado = $descripcionEstado;
    }


}
