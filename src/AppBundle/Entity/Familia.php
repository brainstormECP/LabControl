<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:22
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="familia")
 * @ORM\Entity()
 */
class Familia {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    protected $nombre;


    /**
     * @var genero[]
     * @ORM\OneToMany(targetEntity="Genero", mappedBy="familia")
     */
    protected $generos;

    public function __construct(){
        $this->generos = new ArrayCollection();
    }

    public function __toString(){
        return $this->getNombre();
    }


    /**
     * Get Id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Nombre
     *
     * @param string $nombre
     * @return Familia
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get Nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add Generos
     *
     * @param \AppBundle\Entity\Genero $generos
     * @return Familia
     */
    public function addGenero(\AppBundle\Entity\Genero $generos)
    {
        $this->generos[] = $generos;

        return $this;
    }

    /**
     * Remove Genero
     *
     * @param \AppBundle\Entity\Genero $generos
     */
    public function removeGenero(\AppBundle\Entity\Genero $generos)
    {
        $this->generos->removeElement($generos);
    }

    /**
     * Get Muestras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGeneros()
    {
        return $this->generos;
    }
}
