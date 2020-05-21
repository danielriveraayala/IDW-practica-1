<?php


namespace Dashboard\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="album")
 */
class album
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(name="artist",type="string")
     */
    protected $artist;
    /**
     * @ORM\Column(name="title",type="string")
     */
    protected $title;

    /**
     * @ORM\OneToOne(targetEntity="Dashboard\Entity\generos")
     * @ORM\JoinColumn(name="genero_id",referencedColumnName="id")
     */
    protected $generoId;

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
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param $artist
     */
    public function setArtist($artist): void
    {
        $this->artist = $artist;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getGeneroId()
    {
        return $this->generoId;
    }

    /**
     * @param mixed $generoId
     */
    public function setGeneroId($generoId): void
    {
        $this->generoId = $generoId;
    }

}