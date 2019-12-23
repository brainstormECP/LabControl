<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 09/10/2015
 * Time: 05:37:PM
 */

namespace AppBundle\ViewModel;

use Doctrine\Common\Collections\ArrayCollection;


class MuestraView {

    protected $id;

    protected $noOrden;

    protected $claveInterna;

    protected $claveExterna;

    protected $experimento;

    protected $tratamientos;

    protected $analisis;

    protected $especie;

    protected $tipoEstudio;

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
     * @return MuestraView
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
     * @return MuestraView
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
     * @return MuestraView
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
     * @return MuestraView
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
     * @return Muestra
     */
    public function setTipoEstudio($tipoEstudio)
    {
        $this->tipoEstudio = $tipoEstudio;

        return $this;
    }

} 