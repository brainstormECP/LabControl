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
 * @ORM\Table(name="genero")
 * @ORM\Entity()
 */
class Genero {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var familia
     * @ORM\ManyToOne(targetEntity="Familia", inversedBy="generos")
     * @ORM\JoinColumn(name="familiaId", referencedColumnName="id")
     */
    protected $familia;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    protected $nombre;



    /**
     * @var muestra[]
     * @ORM\OneToMany(targetEntity="Especie", mappedBy="genero")
     */
    protected $especies;

    public function __construct(){
        $this->especies = new ArrayCollection();
    }

    public function __toString(){
        return $this->getFamilia().' '.$this->getNombre();
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
     * @return Genero
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
     * Add Especies
     *
     * @param \AppBundle\Entity\Especie $especies
     * @return Genero
     */
    public function addEspecie(\AppBundle\Entity\Especie $especies)
    {
        $this->especies[] = $especies;

        return $this;
    }

    /**
     * Remove Especies
     *
     * @param \AppBundle\Entity\Especie $especies
     */
    public function removeEspecie(\AppBundle\Entity\Especie $especies)
    {
        $this->especies->removeElement($especies);
    }

    /**
     * Get Especies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEspecies()
    {
        return $this->especies;
    }

    /**
     * Set Familia
     *
     * @param \AppBundle\Entity\Familia $familia
     * @return Genero
     */
    public function setFamilia(\AppBundle\Entity\Familia $familia = null)
    {
        $this->familia = $familia;

        return $this;
    }

    /**
     * Get Familia
     *
     * @return \AppBundle\Entity\Familia
     */
    public function getFamilia()
    {
        return $this->familia;
    }
}
