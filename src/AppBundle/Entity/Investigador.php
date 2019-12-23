<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 08/07/2015
 * Time: 10:01:PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * SalidaReactivo
 *
 * @ORM\Table(name="investigador")
 * @ORM\Entity
 */
class Investigador extends User {

    /**
     * @ORM\OneToMany(targetEntity="Experimento", mappedBy="investigador")
     */
    protected $experimentos;

    /**
     * @ORM\OneToMany(targetEntity="Muestra", mappedBy="investigador")
     */
    protected $muestras;

    /**
     * @var institucion
     * @ORM\ManyToOne(targetEntity="Institucion", inversedBy="investigadores")
     * @ORM\JoinColumn(name="institucionId", referencedColumnName="id")
     */
    protected $institucion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->experimentos = new ArrayCollection();
        $this->muestras = new ArrayCollection();
    }


    /**
     * Add Experimentos
     *
     * @param \AppBundle\Entity\Experimento $experimentos
     * @return Investigador
     */
    public function addExperimento(\AppBundle\Entity\Experimento $experimentos)
    {
        $this->experimentos[] = $experimentos;

        return $this;
    }

    /**
     * Remove Experimentos
     *
     * @param \AppBundle\Entity\Experimento $experimentos
     */
    public function removeExperimento(\AppBundle\Entity\Experimento $experimentos)
    {
        $this->experimentos->removeElement($experimentos);
    }

    /**
     * Get Experimentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExperimentos()
    {
        return $this->experimentos;
    }

    /**
     * Add muestras
     *
     * @param \AppBundle\Entity\Muestra $muestras
     * @return Investigador
     */
    public function addMuestras(\AppBundle\Entity\Muestra $muestras)
    {
        $this->muestras[] = $muestras;

        return $this;
    }

    /**
     * Remove muestras
     *
     * @param \AppBundle\Entity\Muestra $muestras
     */
    public function removeMuestra(\AppBundle\Entity\Muestra $muestras)
    {
        $this->experimentos->removeElement($muestras);
    }

    /**
     * Get muestras
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMuestras()
    {
        return $this->muestras;
    }

    /**
     * Set Institucion
     *
     * @param \AppBundle\Entity\Institucion $institucion
     * @return Investigador
     */
    public function setInstitucion(\AppBundle\Entity\Institucion $institucion = null)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return \AppBundle\Entity\Institucion
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    public function rolesToString(){
        $ret = '';
        foreach($this->getRoles() as $r){
            $ret = $ret." ".$r;
        }
        return $ret;
    }

    public function __toString(){
        return $this->getName();
    }
}
