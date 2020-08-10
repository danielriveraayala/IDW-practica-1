<?php


namespace CoursesAndWorkshops\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cursos_y_talleres")
 */
class cursosYTalleres
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="CoursesAndWorkshops\Entity\catTipoDuracion")
     * @ORM\JoinColumn(name="cat_tipo_duracion_id",referencedColumnName="id")
     */
    protected $catTipoDuracionId;
    /**
     * @ORM\ManyToOne(targetEntity="CoursesAndWorkshops\Entity\catTipoRegistro")
     * @ORM\JoinColumn(name="cat_tipo_registro_id",referencedColumnName="id")
     */
    protected $catTipoRegistroId;
    /**
     * @ORM\ManyToOne(targetEntity="CoursesAndWorkshops\Entity\catModalidad")
     * @ORM\JoinColumn(name="cat_modalidad_id",referencedColumnName="id")
     */
    protected $catModalidadId;
    /**
     * @ORM\ManyToOne(targetEntity="CoursesAndWorkshops\Entity\catTipoCursoTaller")
     * @ORM\JoinColumn(name="cat_tipo_curso_taller_id",referencedColumnName="id")
     */
    protected $catTipoCursoTallerId;
    /**
     * @ORM\Column(name="titulo",type="string",nullable=false,length=255)
     */
    protected $titulo;
    /**
     * @ORM\Column(name="subtitulo",type="string",nullable=true,length=255)
     */
    protected $subtitulo;
    /**
     * @ORM\Column(name="introduccion",type="text",nullable=false)
     */
    protected $introduccion;
    /**
     * @ORM\Column(name="fecha_inicio",type="date",nullable=false)
     */
    protected $fechaInicio;
    /**
     * @ORM\Column(name="hora_inicio",type="string",nullable=true,length=255)
     */
    protected $horaInicio;
    /**
     * @ORM\Column(name="fecha_termino",type="date",nullable=false)
     */
    protected $fechaTermino;
    /**
     * @ORM\Column(name="hora_termino",type="string",nullable=true,length=255)
     */
    protected $horaTermino;
    /**
     * @ORM\Column(name="costo",type="integer",nullable=false,length=11)
     */
    protected $costo;
    /**
     * @ORM\Column(name="num_min_integrantes",type="integer",nullable=false,length=11)
     */
    protected $numMinIntegrantes;
    /**
     * @ORM\Column(name="num_max_integrantes",type="integer",nullable=false,length=11)
     */
    protected $numMaxIntegrantes;
    /**
     * @ORM\Column(name="si_constancia",type="boolean",nullable=false)
     */
    protected $siConstancia;
    /**
     * @ORM\Column(name="ponentes",type="string",nullable=false,length=255)
     */
    protected $ponentes;
    /**
     * @ORM\Column(name="duracion",type="integer",nullable=false,length=11)
     */
    protected $duracion;
    /**
     * @ORM\Column(name="domicilio",type="string",nullable=true,length=255)
     */
    protected $domicilio;
    /**
     * @ORM\Column(name="contactos",type="text",nullable=true)
     */
    protected $contactos;
    /**
     * @ORM\Column(name="programa",type="text",nullable=true)
     */
    protected $programa;
    /**
     * @ORM\Column(name="convenio",type="text",nullable=true)
     */
    protected $convenio;
    /**
     * @ORM\Column(name="palabras_clave",type="string",nullable=true,length=255)
     */
    protected $palabrasClave;
    /**
     * @ORM\ManyToOne(targetEntity="CoursesAndWorkshops\Entity\catEstatusPublicacion")
     * @ORM\JoinColumn(name="cat_estatus_publicacion_id",referencedColumnName="id")
     */
    protected $catEstatusPublicacionId;
    /**
     * @ORM\Column(name="link_externo",type="string",nullable=true,length=255)
     */
    protected $linkExterno;
    /**
     * @ORM\Column(name="dirigido_a",type="string",nullable=true,length=255)
     */
    protected $dirigidoA;
    /**
     * @ORM\ManyToMany(targetEntity="Users\Entity\User")
     * @ORM\JoinTable(name="inscripciones",joinColumns={@ORM\JoinColumn(name="cursos_id",referencedColumnName="id")},inverseJoinColumns={@ORM\JoinColumn(name="user_id",referencedColumnName="id", unique=true)})
     */
    protected $inscribed;

    public function __construct()
    {
        $this->inscribed = new ArrayCollection();
    }

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
    public function getCatTipoDuracionId()
    {
        return $this->catTipoDuracionId;
    }

    /**
     * @param mixed $catTipoDuracionId
     */
    public function setCatTipoDuracionId($catTipoDuracionId): void
    {
        $this->catTipoDuracionId = $catTipoDuracionId;
    }

    /**
     * @return mixed
     */
    public function getCatTipoRegistroId()
    {
        return $this->catTipoRegistroId;
    }

    /**
     * @param mixed $catTipoRegistroId
     */
    public function setCatTipoRegistroId($catTipoRegistroId): void
    {
        $this->catTipoRegistroId = $catTipoRegistroId;
    }

    /**
     * @return mixed
     */
    public function getCatModalidadId()
    {
        return $this->catModalidadId;
    }

    /**
     * @param mixed $catModalidadId
     */
    public function setCatModalidadId($catModalidadId): void
    {
        $this->catModalidadId = $catModalidadId;
    }

    /**
     * @return mixed
     */
    public function getCatTipoCursoTallerId()
    {
        return $this->catTipoCursoTallerId;
    }

    /**
     * @param mixed $catTipoCursoTallerId
     */
    public function setCatTipoCursoTallerId($catTipoCursoTallerId): void
    {
        $this->catTipoCursoTallerId = $catTipoCursoTallerId;
    }


    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    /**
     * @param mixed $subtitulo
     */
    public function setSubtitulo($subtitulo): void
    {
        $this->subtitulo = $subtitulo;
    }

    /**
     * @return mixed
     */
    public function getIntroduccion()
    {
        return $this->introduccion;
    }

    /**
     * @param mixed $introduccion
     */
    public function setIntroduccion($introduccion): void
    {
        $this->introduccion = $introduccion;
    }

    /**
     * @return mixed
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * @param mixed $fechaInicio
     */
    public function setFechaInicio($fechaInicio): void
    {
        $this->fechaInicio = $fechaInicio;
    }

    /**
     * @return mixed
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * @param mixed $horaInicio
     */
    public function setHoraInicio($horaInicio): void
    {
        $this->horaInicio = $horaInicio;
    }

    /**
     * @return mixed
     */
    public function getFechaTermino()
    {
        return $this->fechaTermino;
    }

    /**
     * @param mixed $fechaTermino
     */
    public function setFechaTermino($fechaTermino): void
    {
        $this->fechaTermino = $fechaTermino;
    }

    /**
     * @return mixed
     */
    public function getHoraTermino()
    {
        return $this->horaTermino;
    }

    /**
     * @param mixed $horaTermino
     */
    public function setHoraTermino($horaTermino): void
    {
        $this->horaTermino = $horaTermino;
    }

    /**
     * @return mixed
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param mixed $costo
     */
    public function setCosto($costo): void
    {
        $this->costo = $costo;
    }

    /**
     * @return mixed
     */
    public function getNumMinIntegrantes()
    {
        return $this->numMinIntegrantes;
    }

    /**
     * @param mixed $numMinIntegrantes
     */
    public function setNumMinIntegrantes($numMinIntegrantes): void
    {
        $this->numMinIntegrantes = $numMinIntegrantes;
    }

    /**
     * @return mixed
     */
    public function getNumMaxIntegrantes()
    {
        return $this->numMaxIntegrantes;
    }

    /**
     * @param mixed $numMaxIntegrantes
     */
    public function setNumMaxIntegrantes($numMaxIntegrantes): void
    {
        $this->numMaxIntegrantes = $numMaxIntegrantes;
    }

    /**
     * @return mixed
     */
    public function getSiConstancia()
    {
        return $this->siConstancia;
    }

    /**
     * @param mixed $siConstancia
     */
    public function setSiConstancia($siConstancia): void
    {
        $this->siConstancia = $siConstancia;
    }

    /**
     * @return mixed
     */
    public function getPonentes()
    {
        return $this->ponentes;
    }

    /**
     * @param mixed $ponentes
     */
    public function setPonentes($ponentes): void
    {
        $this->ponentes = $ponentes;
    }

    /**
     * @return mixed
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * @param mixed $duracion
     */
    public function setDuracion($duracion): void
    {
        $this->duracion = $duracion;
    }

    /**
     * @return mixed
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * @param mixed $domicilio
     */
    public function setDomicilio($domicilio): void
    {
        $this->domicilio = $domicilio;
    }

    /**
     * @return mixed
     */
    public function getContactos()
    {
        return $this->contactos;
    }

    /**
     * @param mixed $contactos
     */
    public function setContactos($contactos): void
    {
        $this->contactos = $contactos;
    }

    /**
     * @return mixed
     */
    public function getPrograma()
    {
        return $this->programa;
    }

    /**
     * @param mixed $programa
     */
    public function setPrograma($programa): void
    {
        $this->programa = $programa;
    }

    /**
     * @return mixed
     */
    public function getConvenio()
    {
        return $this->convenio;
    }

    /**
     * @param mixed $convenio
     */
    public function setConvenio($convenio): void
    {
        $this->convenio = $convenio;
    }

    /**
     * @return mixed
     */
    public function getPalabrasClave()
    {
        return $this->palabrasClave;
    }

    /**
     * @param mixed $palabrasClave
     */
    public function setPalabrasClave($palabrasClave): void
    {
        $this->palabrasClave = $palabrasClave;
    }

    /**
     * @return mixed
     */
    public function getCatEstatusPublicacionId()
    {
        return $this->catEstatusPublicacionId;
    }

    /**
     * @param mixed $catEstatusPublicacionId
     */
    public function setCatEstatusPublicacionId($catEstatusPublicacionId): void
    {
        $this->catEstatusPublicacionId = $catEstatusPublicacionId;
    }

    /**
     * @return mixed
     */
    public function getLinkExterno()
    {
        return $this->linkExterno;
    }

    /**
     * @param mixed $linkExterno
     */
    public function setLinkExterno($linkExterno): void
    {
        $this->linkExterno = $linkExterno;
    }

    /**
     * @return mixed
     */
    public function getDirigidoA()
    {
        return $this->dirigidoA;
    }

    /**
     * @param mixed $dirigidoA
     */
    public function setDirigidoA($dirigidoA): void
    {
        $this->dirigidoA = $dirigidoA;
    }

    /**
     * @return Collection
     */
    public function getInscribed(): Collection
    {
        return $this->inscribed;
    }


}