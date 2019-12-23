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
 * @ORM\Table(name="otro_tipo_muestra")
 * @ORM\Entity()
 */
class OtroTipoMuestra {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    protected $nombre;


    /**
     * @var muestra[]
     * @ORM\OneToMany(targetEntity="OtraMuestra", mappedBy="tipo")
     */
    protected $muestras;

    public function __construct(){
        $this->muestras = new ArrayCollection();
    }

    public function __toString(){
        return $this->getNombre();
    }


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
     * Set Nombre
     *
     * @param string $nombre
     * @return OtroTipoMuestra
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get Nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add Muestras
     *
     * @param \AppBundle\Entity\OtraMuestra $muestras
     * @return OtroTipoMuestra
     */
    public function addMuestra(\AppBundle\Entity\OtraMuestra $muestras)
    {
        $this->muestras[] = $muestras;

        return $this;
    }

    /**
     * Remove Muestras
     *
     * @param \AppBundle\Entity\OtraMuestra $muestras
     */
    public function removeMuestra(\AppBundle\Entity\OtraMuestra $muestras)
    {
        $this->muestras->removeElement($muestras);
    }

    /**
     * Get Muestras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMuestras()
    {
        return $this->muestras;
    }
}
