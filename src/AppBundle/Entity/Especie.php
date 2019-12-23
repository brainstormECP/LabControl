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
 * @ORM\Table(name="especie")
 * @ORM\Entity()
 */
class Especie {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var genero
     * @ORM\ManyToOne(targetEntity="Genero", inversedBy="especies")
     * @ORM\JoinColumn(name="generoId", referencedColumnName="id")
     */
    protected $genero;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    protected $nombre;


    /**
     * @var muestra[]
     * @ORM\OneToMany(targetEntity="Pasto", mappedBy="especie")
     */
    protected $muestras;

    public function __construct(){
        $this->muestras = new ArrayCollection();
    }

    public function __toString(){
        return $this->getGenero().' '.$this->getNombre();
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
     * Set Genero
     *
     * @param \AppBundle\Entity\Genero $genero
     * @return Especie
     */
    public function setGenero(\AppBundle\Entity\Genero $genero = null)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get Genero
     *
     * @return \AppBundle\Entity\Genero
     */
    public function getGenero()
    {
        return $this->genero;
    }


    /**
     * Set Nombre
     *
     * @param string $nombre
     * @return Especie
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
     * Add Muestras
     *
     * @param \AppBundle\Entity\Pasto $muestras
     * @return Especie
     */
    public function addMuestra(\AppBundle\Entity\Pasto $muestras)
    {
        $this->muestras[] = $muestras;

        return $this;
    }

    /**
     * Remove Muestras
     *
     * @param \AppBundle\Entity\Pasto $muestras
     */
    public function removeMuestra(\AppBundle\Entity\Pasto $muestras)
    {
        $this->muestras->removeElement($muestras);
    }

    /**
     * Get Muestras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMuestras()
    {
        return $this->muestras;
    }
}
