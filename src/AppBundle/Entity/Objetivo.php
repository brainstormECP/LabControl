<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:25
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="objetivo")
 * @ORM\Entity()
 */
class Objetivo {

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
    protected $descripcion;

    /**
     * @var experimento
     * @ORM\ManyToOne(targetEntity="Experimento", inversedBy="objetivos")
     * @ORM\JoinColumn(name="experimentoId", referencedColumnName="id")
     */
    protected $experimento;

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
     * Set Descripcion
     *
     * @param string $descripcion
     * @return Objetivo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
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
     * Set Experimento
     *
     * @param \AppBundle\Entity\Experimento $experimento
     * @return Objetivo
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
}
