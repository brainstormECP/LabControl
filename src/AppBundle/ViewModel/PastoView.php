<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 09/10/2015
 * Time: 05:37:PM
 */

namespace AppBundle\ViewModel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


class PastoView {

    protected $id;

    protected $especie;

    protected $experimento;

    protected $tratamientos;

    protected $analisis;

    protected $tipoEstudio;

    protected $dias;

    protected $epoca;

    public function __construct(){
        $this->tratamientos = new ArrayCollection();
        $this->analisis = new ArrayCollection();
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
     * Set Experimento
     *
     * @param \AppBundle\Entity\Experimento $experimento
     * @return PastoView
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
     * @return PastoView
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
     * @return PastoView
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
     * Add Analisis
     *
     * @param \AppBundle\Entity\Analisis $analisis
     * @return PastoView
     */
    public function addAnalisis(\AppBundle\Entity\Analisis $analisis)
    {
        $this->analisis[] = $analisis;

        return $this;
    }

    /**
     * Remove Analisis
     *
     * @param \AppBundle\Entity\Analisis $analisis
     */
    public function removeAnalisis(\AppBundle\Entity\Analisis $analisis)
    {
        $this->analisis->removeElement($analisis);
    }

    /**
     * Get Analisis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnalisis()
    {
        return $this->analisis;
    }

    public function getAnalisisPendientes()
    {
        return true;
    }

    /**
     * Get TipoEstudio
     *
     * @return string
     */
    public function getTipoEstudio()
    {
        return $this->tipoEstudio;
    }

    /**
     * Set TipoEstudio
     *
     * @param string $tipoEstudio
     * @return PastoView
     */
    public function setTipoEstudio($tipoEstudio)
    {
        $this->tipoEstudio = $tipoEstudio;

        return $this;
    }

    /**
     * Set tipoEstudio
     *
     * @param integer $dias
     * @return Pasto
     */
    public function setDias($dias)
    {
        $this->dias = $dias;

        return $this;
    }

    /**
     * Get dias
     *
     * @return integer
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * Set epoca
     *
     * @param string $epoca
     * @return Pasto
     */
    public function setEpoca($epoca)
    {
        $this->epoca = $epoca;

        return $this;
    }

    /**
     * Get epoca
     *
     * @return string
     */
    public function getEpoca()
    {
        return $this->epoca;
    }

} 