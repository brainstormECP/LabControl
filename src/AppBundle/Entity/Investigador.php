<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 08/07/2015
 * Time: 10:01:PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * Constructor
     */
    public function __construct()
    {
        $this->experimentos = new ArrayCollection();
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
}
