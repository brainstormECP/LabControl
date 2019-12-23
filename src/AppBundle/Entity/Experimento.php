<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:24
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="experimento")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ExperimentoRepository")
 */
class Experimento {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    protected $fechaInicio;

    /**
     * @var \DateTime
     * @ORM\Column(type="date",nullable=true )
     */
    protected $fechaFin;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=true)
     */
    protected $observaciones;

    /**
     * @var investigador
     * @ORM\ManyToOne(targetEntity="Investigador", inversedBy="experimentos")
     * @ORM\JoinColumn(name="investigadorId", referencedColumnName="id")
     */
    protected $investigador;

    /**
     * @var actividadCientifica
     * @ORM\ManyToOne(targetEntity="ActividadCientifica", inversedBy="experimentos")
     * @ORM\JoinColumn(name="actividadCientificaId", referencedColumnName="id")
     */
    protected $actividadCientifica;

    /**
     * @ORM\OneToMany(targetEntity="Objetivo", mappedBy="experimento")
     */
    protected $objetivos;

    /**
     * @ORM\OneToMany(targetEntity="PlanificacionCorteExperimento", mappedBy="experimento")
     */
    protected $cortes;

    /**
     * @ORM\OneToMany(targetEntity="Muestra", mappedBy="experimento")
     */
    protected $muestras;

    public function __construct(){
        $this->objetivos = new ArrayCollection();
        $this->muestras = new ArrayCollection();
        $this->cortes = new ArrayCollection();
    }

    public function __toString(){
        $result = date('d/M/y', $this->getFechaInicio()->getTimestamp());
        if($this->getActividadCientifica()){
            $result = $result.' - '.$this->getActividadCientifica()->getNombre();
        }
        return $result;
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
     * Set FechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Experimento
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get FechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set FechaFin
     *
     * @param \DateTime $fechaFin
     * @return Experimento
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get FechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set Observaciones
     *
     * @param string $observaciones
     * @return Experimento
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get Observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }



    /**
     * Set Trabajo
     *
     * @param \AppBundle\Entity\ActividadCientifica $actividadCientifica
     * @return Experimento
     */
    public function setActividadCientifica(\AppBundle\Entity\ActividadCientifica $actividadCientifica = null)
    {
        $this->actividadCientifica = $actividadCientifica;

        return $this;
    }

    /**
     * Get Trabajo
     *
     * @return \AppBundle\Entity\ActividadCientifica
     */
    public function getActividadCientifica()
    {
        return $this->actividadCientifica;
    }

    /**
     * Add Objetivos
     *
     * @param \AppBundle\Entity\Objetivo $objetivos
     * @return Experimento
     */
    public function addObjetivo(\AppBundle\Entity\Objetivo $objetivos)
    {
        $this->objetivos[] = $objetivos;

        return $this;
    }

    /**
     * Remove Objetivos
     *
     * @param \AppBundle\Entity\Objetivo $objetivos
     */
    public function removeObjetivo(\AppBundle\Entity\Objetivo $objetivos)
    {
        $this->objetivos->removeElement($objetivos);
    }

    /**
     * Get Objetivos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getObjetivos()
    {
        return $this->objetivos;
    }

    /**
     * Add Muestras
     *
     * @param \AppBundle\Entity\Muestra $muestras
     * @return Experimento
     */
    public function addMuestra(\AppBundle\Entity\Muestra $muestras)
    {
        $this->muestras[] = $muestras;

        return $this;
    }

    /**
     * Remove Muestras
     *
     * @param \AppBundle\Entity\Muestra $muestras
     */
    public function removeMuestra(\AppBundle\Entity\Muestra $muestras)
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

    /**
     * Add PlanificacionCorteExperimento
     *
     * @param \AppBundle\Entity\PlanificacionCorteExperimento $cortes
     * @return Experimento
     */
    public function addCorte(\AppBundle\Entity\PlanificacionCorteExperimento $cortes)
    {
        $this->cortes[] = $cortes;

        return $this;
    }

    /**
     * Remove PlanificacionCorteExperimento
     *
     * @param \AppBundle\Entity\PlanificacionCorteExperimento $cortes
     */
    public function removeCorte(\AppBundle\Entity\PlanificacionCorteExperimento $cortes)
    {
        $this->cortes->removeElement($cortes);
    }

    /**
     * Get PlanificacionCorteExperimento
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCortes()
    {
        return $this->cortes;
    }

    /**
     * Set Investigador
     *
     * @param \AppBundle\Entity\Investigador $investigador
     * @return Experimento
     */
    public function setInvestigador(\AppBundle\Entity\Investigador $investigador = null)
    {
        $this->investigador = $investigador;

        return $this;
    }

    /**
     * Get Investigador
     *
     * @return \AppBundle\Entity\Investigador 
     */
    public function getInvestigador()
    {
        return $this->investigador;
    }
}
