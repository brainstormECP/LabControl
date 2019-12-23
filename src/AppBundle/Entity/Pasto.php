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
 * @ORM\Table(name="pasto")
 * @ORM\Entity()
 */
class Pasto extends Muestra{

    /**
     * @var especie
     * @ORM\ManyToOne(targetEntity="Especie", inversedBy="muestras")
     * @ORM\JoinColumn(name="especieId", referencedColumnName="id")
     */
    protected $especie;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    protected $dias;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $epoca;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $tipoEstudio;


    /**
     * Set Especie
     *
     * @param \AppBundle\Entity\Especie $especie
     * @return Pasto
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
     * Set tipoEstudio
     *
     * @param string $tipoEstudio
     * @return Pasto
     */
    public function setTipoEstudio($tipoEstudio)
    {
        $this->tipoEstudio = $tipoEstudio;

        return $this;
    }

    /**
     * Get tipoEstudio
     *
     * @return string
     */
    public function getTipoEstudio()
    {
        return $this->tipoEstudio;
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

    public function __toString(){
        return $this->getEspecie().' ('.$this->getEpoca().' - '.$this->getDias().')';
    }



}
