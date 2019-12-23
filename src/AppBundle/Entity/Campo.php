<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 08:53:AM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="campo")
 * @ORM\Entity()
 */
class Campo {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $nombre;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $abreviatura;

    /**
     * @var analisis
     * @ORM\ManyToOne(targetEntity="Analisis",inversedBy="campos")
     * @ORM\JoinColumn(name="analisisId",referencedColumnName="id")
     */
    protected $analisis;

    /**
     * @ORM\OneToMany(targetEntity="CampoAnalisisValor",mappedBy="campo")
     */
    protected $campoAnalisisValores;


    public function __construct(){
        $this->campoAnalisisValores = new ArrayCollection();
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
     * @return Campo
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
     * Set Nombre
     *
     * @param string $abreviatura
     * @return Campo
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get Nombre
     *
     * @return string
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set Analisis
     *
     * @param \AppBundle\Entity\Analisis $analisis
     * @return Campo
     */
    public function setAnalisis(\AppBundle\Entity\Analisis $analisis = null)
    {
        $this->analisis = $analisis;

        return $this;
    }

    /**
     * Set Analisis
     *
     * @param \AppBundle\Entity\Analisis $analisis
     * @return Campo
     */
    public function addAnalisis(\AppBundle\Entity\Analisis $analisis)
    {
        $this->setAnalisis($analisis);
        return $this;
    }

    /**
     * Get Analisis
     *
     * @return \AppBundle\Entity\Analisis 
     */
    public function getAnalisis()
    {
        return $this->analisis;
    }

    /**
     * Add CampoAnalisisValores
     *
     * @param \AppBundle\Entity\CampoAnalisisValor $campoAnalisisValores
     * @return Campo
     */
    public function addCampoAnalisisValore(\AppBundle\Entity\CampoAnalisisValor $campoAnalisisValores)
    {
        $this->campoAnalisisValores[] = $campoAnalisisValores;

        return $this;
    }

    /**
     * Remove CampoAnalisisValores
     *
     * @param \AppBundle\Entity\CampoAnalisisValor $campoAnalisisValores
     */
    public function removeCampoAnalisisValore(\AppBundle\Entity\CampoAnalisisValor $campoAnalisisValores)
    {
        $this->campoAnalisisValores->removeElement($campoAnalisisValores);
    }

    /**
     * Get CampoAnalisisValores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCampoAnalisisValores()
    {
        return $this->campoAnalisisValores;
    }
}
