<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 08/07/2015
 * Time: 10:02:PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * SalidaReactivo
 *
 * @ORM\Table(name="tecnico_laboratorio")
 * @ORM\Entity
 */
class TecnicoLaboratorio extends User{

    /**
     * @ORM\OneToMany(targetEntity="AnalisisMuestra", mappedBy="tecnicoLaboratorio")
     */
    protected $analisisMuestras;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->analisisMuestras = new ArrayCollection();
    }

    /**
     * Add AnalisisMuestras
     *
     * @param \AppBundle\Entity\AnalisisMuestra $analisisMuestras
     * @return TecnicoLaboratorio
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
