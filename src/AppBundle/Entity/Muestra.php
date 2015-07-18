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
 * @ORM\Table(name="muestra")
 * @ORM\Entity()
 */
class Muestra {

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
    protected $noOrden;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $claveInterna;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $claveExterna;

    /**
     * @var experimento
     * @ORM\ManyToOne(targetEntity="Experimento", inversedBy="muestras")
     * @ORM\JoinColumn(name="experimentoId", referencedColumnName="id")
     */
    protected $experimento;

    /**
     * @var tratamiento[]
     * @ORM\ManyToMany(targetEntity="Tratamiento", mappedBy="muestra")
     */
    protected $tratamientos;

    /**
     * @var analisisMuestra[]
     * @ORM\OneToMany(targetEntity="AnalisisMuestra", mappedBy="muestra")
     */
    protected $analisisMuestras;

    /**
     * @var especie
     * @ORM\ManyToOne(targetEntity="Especie", inversedBy="muestras")
     * @ORM\JoinColumn(name="especieId", referencedColumnName="id")
     */
    protected $especie;

    public function __construct(){
        $this->tratamientos = new ArrayCollection();
        $this->analisisMuestras = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set NoOrden
     *
     * @param string $noOrden
     * @return Muestra
     */
    public function setNoOrden($noOrden)
    {
        $this->noOrden = $noOrden;

        return $this;
    }

    /**
     * Get NoOrden
     *
     * @return string 
     */
    public function getNoOrden()
    {
        return $this->noOrden;
    }

    /**
     * Set ClaveInterna
     *
     * @param string $claveInterna
     * @return Muestra
     */
    public function setClaveInterna($claveInterna)
    {
        $this->claveInterna = $claveInterna;

        return $this;
    }

    /**
     * Get ClaveInterna
     *
     * @return string 
     */
    public function getClaveInterna()
    {
        return $this->claveInterna;
    }

    /**
     * Set ClaveExterna
     *
     * @param string $claveExterna
     * @return Muestra
     */
    public function setClaveExterna($claveExterna)
    {
        $this->claveExterna = $claveExterna;

        return $this;
    }

    /**
     * Get ClaveExterna
     *
     * @return string 
     */
    public function getClaveExterna()
    {
        return $this->claveExterna;
    }

    /**
     * Set Experimento
     *
     * @param \AppBundle\Entity\Experimento $experimento
     * @return Muestra
     */
    public function setExperimento(\AppBundle\Entity\Experimento $experimento = null)
    {
        $this->experimento = $experimento;

        return $this;
    }

    /**
     * Get Experimento
     *
     * @return \AppBundle\Entity\Experimento 
     */
    public function getExperimento()
    {
        return $this->experimento;
    }

    /**
     * Add Tratamientos
     *
     * @param \AppBundle\Entity\Tratamiento $tratamientos
     * @return Muestra
     */
    public function addTratamiento(\AppBundle\Entity\Tratamiento $tratamientos)
    {
        $this->tratamientos[] = $tratamientos;

        return $this;
    }

    /**
     * Remove Tratamientos
     *
     * @param \AppBundle\Entity\Tratamiento $tratamientos
     */
    public function removeTratamiento(\AppBundle\Entity\Tratamiento $tratamientos)
    {
        $this->tratamientos->removeElement($tratamientos);
    }

    /**
     * Get Tratamientos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTratamientos()
    {
        return $this->tratamientos;
    }

    /**
     * Set Especie
     *
     * @param \AppBundle\Entity\Especie $especie
     * @return Muestra
     */
    public function setEspecie(\AppBundle\Entity\Especie $especie = null)
    {
        $this->especie = $especie;

        return $this;
    }

    /**
     * Get Especie
     *
     * @return \AppBundle\Entity\Especie 
     */
    public function getEspecie()
    {
        return $this->especie;
    }

    /**
     * Add AnalisisMuestras
     *
     * @param \AppBundle\Entity\AnalisisMuestra $analisisMuestras
     * @return Muestra
     */
    public function addAnalisisMuestra(\AppBundle\Entity\AnalisisMuestra $analisisMuestras)
    {
        $this->analisisMuestras[] = $analisisMuestras;

        return $this;
    }

    /**
     * Remove AnalisisMuestras
     *
     * @param \AppBundle\Entity\AnalisisMuestra $analisisMuestras
     */
    public function removeAnalisisMuestra(\AppBundle\Entity\AnalisisMuestra $analisisMuestras)
    {
        $this->analisisMuestras->removeElement($analisisMuestras);
    }

    /**
     * Get AnalisisMuestras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnalisisMuestras()
    {
        return $this->analisisMuestras;
    }
}
