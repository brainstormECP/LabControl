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


class OtraMuestraView {

    protected $id;

    protected $tipo;

    protected $descripcion;

    protected $experimento;

    protected $tratamientos;

    protected $analisis;

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
     * Set OtroTipoMuestra
     *
     * @param \AppBundle\Entity\OtroTipoMuestra $tipo
     * @return OtraMuestraView
     */
    public function setTipo(\AppBundle\Entity\OtroTipoMuestra $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get OtroTipoMuestra
     *
     * @return \AppBundle\Entity\OtroTipoMuestra
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set Experimento
     *
     * @param \AppBundle\Entity\Experimento $experimento
     * @return OtraMuestraView
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

    public function getAnalisisPendientes()
    {
        return true;
    }

    /**
     * Get Descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set Descripcion
     *
     * @param string $descripcion
     * @return OtraMuestraView
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Add Analisis
     *
     * @param \AppBundle\Entity\Analisis $analisis
     * @return OtraMuestraView
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

} 