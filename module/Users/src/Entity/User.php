<?php
/**
 * Copyright (c) 2019. @author Desarrollo hecho por danielriveraayala@gmail.com
 */

namespace Users\Entity;

use CoursesAndWorkshops\Entity\cursosYTalleres;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    // User status constants.
    /**
     *
     */
    const SUPER_ADMIN = 2; // root
    /**
     *
     */
    const STATUS_ACTIVE = 1; // Active user.
    /**
     *
     */
    const STATUS_RETIRED = 0; // Retired user.
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id",type="integer")
     */
    protected $id;
    /**
     * Un usuario vive solo en un estado de la republica
     * @ORM\ManyToOne(targetEntity="Users\Entity\catEstadoRepMex")
     * @ORM\JoinColumn(name="cat_estado_idcat_estado", referencedColumnName="id")
     */
    protected $catEstadoIdcatEstado;
    /**
     * Un usuario tiene solo un genero
     * @ORM\ManyToOne(targetEntity="Users\Entity\Genero")
     * @ORM\JoinColumn(name="cat_genero_idcat_genero", referencedColumnName="id")
     */
    protected $catGeneroIdcatGenero;
    /**
     * @ORM\Column(name="nombres",type="string",nullable=true)
     */
    protected $nombres;
    /**
     * @ORM\Column(name="primer_apellido",type="string",nullable=true)
     */
    protected $primerApellido;
    /**
     * @ORM\Column(name="segundo_apellido",type="string",nullable=true)
     */
    protected $segundoApellido;
    /**
     * @ORM\Column(name="telefono",type="integer",nullable=true)
     */
    protected $telefono;
    /**
     * @ORM\Column(name="CURP",type="string",nullable=true)
     */
    protected $CURP;
    /**
     * @ORM\Column(name="RFC",type="string",nullable=true)
     */
    protected $RFC;
    /**
     * @ORM\Column(name="direccion",type="string",nullable=true)
     */
    protected $direccion;
    /**
     * @ORM\Column(name="colonia",type="string",nullable=true)
     */
    protected $colonia;
    /**
     * @ORM\Column(name="codigo_postal",type="string",nullable=true)
     */
    protected $codigoPostal;
    /**
     * @ORM\Column(name="ciudad",type="string",nullable=true)
     */
    protected $ciudad;
    /**
     * @ORM\Column(name="email",type="string",nullable=false)
     */
    protected $email;
    /**
     * @ORM\Column(name="verified_mail",type="integer",nullable=true)
     */
    protected $verifiedMail;
    /**
     * @ORM\Column(name="verified_mail_token", type="string",nullable=true)
     */
    protected $verifiedMailToken;
    /**
     * @ORM\Column(name="password", type="string",nullable=true)
     */
    protected $password;
    /**
     * @ORM\Column(name="pwd_reset_token", type="string",nullable=true)
     */
    protected $pwdResetToken;
    /**
     * @ORM\Column(name="pwd_reset_token_creation_date", type="datetime",nullable=true)
     */
    protected $pwdResetTokenCreationDate;
    /**
     * @ORM\Column(name="fecha_registro",type="datetime",nullable=true)
     */
    protected $fechaRegistro;
    /**
     * @ORM\Column(name="status", type="integer",nullable=false)
     */
    protected $status = self::STATUS_ACTIVE;
    /**
     * @ORM\Column(name="verified_user_token", type="string",nullable=true)
     */
    protected $verifiedUserToken;
    /**
     * @ORM\Column(name="verified_user_status", type="boolean",nullable=true)
     */
    protected $verifiedUserStatus;
    /**
     * @ORM\Column(name="avatar",type="text",nullable=true)
     */
    protected $avatar = 'data:image/png;base64,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';
    /**
     * @ORM\Column(name="payer_id",type="string",nullable=true,length=255)
     */
    protected $payerId;
    /**
     * @ORM\Column(name="status_code",type="string",nullable=true,length=255)
     */
    protected $statusCode;
    /**
     * @ORM\Column(name="order_id",type="string",nullable=true,length=255)
     */
    protected $orderId;
    /**
     * @ORM\Column(name="result_status",type="string",nullable=true,length=255)
     */
    protected $resultStatus;
    /**
     * @ORM\Column(name="custom_id",type="string",nullable=true,length=255)
     */
    protected $customId;
    /**
     * @ORM\Column(name="soft_descriptor",type="string",nullable=true,length=255)
     */
    protected $softDescriptor;
    /**
     * @ORM\ManyToMany(targetEntity="CoursesAndWorkshops\Entity\cursosYTalleres")
     * @ORM\JoinTable(name="inscripciones",joinColumns={@ORM\JoinColumn(name="user_id",referencedColumnName="id")},inverseJoinColumns={@ORM\JoinColumn(name="cursos_id",referencedColumnName="id", unique=true)})
     */
    protected $inscripciones;

    public function __construct()
    {
        $this->inscripciones = new ArrayCollection();
    }

    /**
     * @return int
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
    function getCatEstadoIdcatEstado()
    {
        return $this->catEstadoIdcatEstado;
    }

    /**
     * @param catEstadoRepMex $catEstadoIdcatEstado
     */
    function setCatEstadoIdcatEstado($catEstadoIdcatEstado)
    {
        $this->catEstadoIdcatEstado = $catEstadoIdcatEstado;
    }

    /**
     * @return mixed
     */
    function getCatGeneroIdcatGenero()
    {
        return $this->catGeneroIdcatGenero;
    }

    /**
     * @param $catGeneroIdcatGenero
     */
    function setCatGeneroIdcatGenero($catGeneroIdcatGenero)
    {
        $this->catGeneroIdcatGenero = $catGeneroIdcatGenero;
    }

    /**
     * @return mixed
     */
    function getNombres()
    {
        return $this->nombres;
    }

    /**
     * @param $nombres
     */
    function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * @return mixed
     */
    function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * @param $primerApellido
     */
    function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;
    }

    /**
     * @return mixed
     */
    function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * @param $segundoApellido
     */
    function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;
    }

    /**
     * @return mixed
     */
    function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param $telefono
     */
    function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }


    /**
     * @return mixed
     */
    function getCURP()
    {
        return $this->CURP;
    }

    /**
     * @param $CURP
     */
    function setCURP($CURP)
    {
        $this->CURP = $CURP;
    }

    /**
     * @return mixed
     */
    function getRFC()
    {
        return $this->RFC;
    }

    /**
     * @param $RFC
     */
    function setRFC($RFC)
    {
        $this->RFC = $RFC;
    }


    /**
     * @return mixed
     */
    function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param $direccion
     */
    function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    function getColonia()
    {
        return $this->colonia;
    }

    /**
     * @param $colonia
     */
    function setColonia($colonia)
    {
        $this->colonia = $colonia;
    }

    /**
     * @return mixed
     */
    function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * @param $codigoPostal
     */
    function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;
    }

    /**
     * @return mixed
     */
    function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @param $ciudad
     */
    function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getVerifiedMailToken()
    {
        return $this->verifiedMailToken;
    }

    /**
     * @param mixed $verifiedMailToken
     */
    public function setVerifiedMailToken($verifiedMailToken)
    {
        $this->verifiedMailToken = $verifiedMailToken;
    }


    /**
     * @return mixed
     */
    public function getVerifiedMail()
    {
        return $this->verifiedMail;
    }

    /**
     * @param mixed $verified_mail
     */
    public function setVerifiedMail($verified_mail)
    {
        $this->verifiedMail = $verified_mail;
    }


    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPwdResetToken()
    {
        return $this->pwdResetToken;
    }

    /**
     * @param mixed $pwdResetToken
     */
    public function setPwdResetToken($pwdResetToken)
    {
        $this->pwdResetToken = $pwdResetToken;
    }

    /**
     * @return mixed
     */
    public function getPwdResetTokenCreationDate()
    {
        return $this->pwdResetTokenCreationDate;
    }

    /**
     * @param mixed $pwdResetTokenCreationDate
     */
    public function setPwdResetTokenCreationDate($pwdResetTokenCreationDate)
    {
        $this->pwdResetTokenCreationDate = $pwdResetTokenCreationDate;
    }

    /**
     * @return mixed
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * @param mixed $fechaRegistro
     */
    public function setFechaRegistro($fechaRegistro): void
    {
        $this->fechaRegistro = $fechaRegistro;
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Returns user status as string.
     *
     * @return string
     */
    public function getStatusAsString()
    {
        $list = self::getStatusList();
        if (isset($list[$this->status]))
            return $list[$this->status];

        return 'Unknown';
    }

    /**
     * Returns possible statuses as array.
     *
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Activo',
            self::STATUS_RETIRED => 'Retirado(a)'
        ];
    }

    /**
     * @return mixed
     */
    public function getVerifiedUserToken()
    {
        return $this->verifiedUserToken;
    }

    /**
     * @param mixed $verifiedUserToken
     */
    public function setVerifiedUserToken($verifiedUserToken)
    {
        $this->verifiedUserToken = $verifiedUserToken;
    }

    /**
     * @return mixed
     */
    public function getVerifiedUserStatus()
    {
        return $this->verifiedUserStatus;
    }

    /**
     * @param mixed $verifiedUserStatus
     */
    public function setVerifiedUserStatus($verifiedUserStatus)
    {
        $this->verifiedUserStatus = $verifiedUserStatus;
    }

    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getPayerId()
    {
        return $this->payerId;
    }

    /**
     * @param mixed $payerId
     */
    public function setPayerId($payerId): void
    {
        $this->payerId = $payerId;
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
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
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

    /**
     * @return ArrayCollection
     */
    public function getInscripciones(): Collection
    {
        return $this->inscripciones;
    }

    /**
     * @param cursosYTalleres $curso
     */
    public function setInscripciones(cursosYTalleres $curso)
    {
        $this->inscripciones->add($curso);
    }
}
