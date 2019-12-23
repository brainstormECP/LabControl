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
 * @ORM\Table(name="otra_muestra")
 * @ORM\Entity()
 */
class OtraMuestra extends Muestra{

    /**
     * @var otroTipoMuestra
     * @ORM\ManyToOne(targetEntity="OtroTipoMuestra", inversedBy="muestras")
     * @ORM\JoinColumn(name="tipoId", referencedColumnName="id")
     */
    protected $tipo;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $descripcion;


    /**
     * Set OtroTipoMuestra
     *
     * @param \AppBundle\Entity\OtroTipoMuestra $tipo
     * @return Pasto
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return OtraMuestra
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get epoca
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function __toString(){
        return $this->getTipo()->getNombre();
    }

}
