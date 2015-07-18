<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 16:28
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="analisis_reactivo")
 * @ORM\Entity()
 */
class AnalisisReactivo {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $cantidad;

    /**
     * @var analisis
     * @ORM\ManyToOne(targetEntity="Analisis", inversedBy="analisisReactivos")
     * @ORM\JoinColumn(name="analisisId", referencedColumnName="id")
     */
    protected $analisis;

    /**
     * @var reactivo
     * @ORM\ManyToOne(targetEntity="Reactivo", inversedBy="analisisReactivos")
     * @ORM\JoinColumn(name="reactivoId", referencedColumnName="id")
     */
    protected $reactivo;


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
     * Set Cantidad
     *
     * @param string $cantidad
     * @return AnalisisReactivo
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get Cantidad
     *
     * @return string 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set Analisis
     *
     * @param \AppBundle\Entity\Analisis $analisis
     * @return AnalisisReactivo
     */
    public function setAnalisis(\AppBundle\Entity\Analisis $analisis = null)
    {
        $this->analisis = $analisis;

        return $this;
    }

    /**
     * Get Analisis
     *
     * @return \AppBundle\Entity\Analisis 
     */
    public function getAnalisis()
    {
        return $this->analisis;
    }

    /**
     * Set Reactivo
     *
     * @param \AppBundle\Entity\Reactivo $reactivo
     * @return AnalisisReactivo
     */
    public function setReactivo(\AppBundle\Entity\Reactivo $reactivo = null)
    {
        $this->reactivo = $reactivo;

        return $this;
    }

    /**
     * Get Reactivo
     *
     * @return \AppBundle\Entity\Reactivo 
     */
    public function getReactivo()
    {
        return $this->reactivo;
    }
}
