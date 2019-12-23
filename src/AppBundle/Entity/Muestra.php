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
 * @ORM\Table(name="muestra")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MuestraRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="disc", type="string")
 * @ORM\DiscriminatorMap({
 *  "pasto" = "Pasto",
 *  "otra_muestra" = "OtraMuestra"
 * })
 */
class Muestra
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaRecibida;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $noOrden;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $claveInterna;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $claveExterna;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $estado;

    /**
     * @var experimento
     * @ORM\ManyToOne(targetEntity="Experimento", inversedBy="muestras")
     * @ORM\JoinColumn(name="experimentoId", referencedColumnName="id")
     */
    protected $experimento;

    /**
     * @var tratamiento[]
     * @ORM\ManyToMany(targetEntity="Tratamiento", inversedBy="muestras", cascade="persist" )
     * @ORM\JoinTable(name="tratamiento_muestras")
     */
    protected $tratamientos;

    /**
     * @var analisisMuestra[]
     * @ORM\OneToMany(targetEntity="AnalisisMuestra", mappedBy="muestra", cascade="persist")
     */
    protected $analisisMuestras;

    /**
     * @var investigador
     * @ORM\ManyToOne(targetEntity="Investigador", inversedBy="muestras")
     * @ORM\JoinColumn(name="investigadorId", referencedColumnName="id")
     */
    protected $investigador;

    public function __construct()
    {
        $this->tratamientos = new ArrayCollection();
        $this->analisisMuestras = new ArrayCollection();
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
     * Set FechaRecibida
     *
     * @param \DateTime $fechaRecibida
     * @return Muestra
     */
    public function setFechaRecibida($fechaRecibida)
    {
        $this->fechaRecibida = $fechaRecibida;

        return $this;
    }

    /**
     * Get FechaRecibida
     *
     * @return \DateTime
     */
    public function getFechaRecibida()
    {
        return $this->fechaRecibida;
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
     * Set Estado
     *
     * @param string $estado
     * @return Muestra
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get Estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set Experimento
     *
     * @param \AppBundle\Entity\Experimento $experimento
     * @return Muestra
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
     * @return Muestra
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
     * Add AnalisisMuestras
     *
     * @param \AppBundle\Entity\AnalisisMuestra $analisisMuestras
     * @return Muestra
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

    public function getAnalisisPendientes()
    {
        $cantidadPendientes = 0;
        if ($this->getEstado() == 'Enviada') {
            $cantidadAnalisis = 0;
            foreach ($this->getAnalisisMuestras() as $analisis) {
                $cantidadAnalisis++;
            }
            return $cantidadAnalisis;
        } elseif ($this->getEstado() == 'Recibida') {
            $cantidadAnalisis = 0;
            foreach ($this->getAnalisisMuestras() as $analisis) {
                if ($analisis->getAprobado() && $analisis->getResultado() == "") {
                    $cantidadPendientes++;
                }
                $cantidadAnalisis++;
            }
            return $cantidadPendientes.'/'.$cantidadAnalisis;
        }
        return $cantidadPendientes;
    }


    public function __toString()
    {
        return $this->getClaveInterna();
    }

    /**
     * Set Investigador
     *
     * @param \AppBundle\Entity\Investigador $investigador
     * @return Muestra
     */
    public function setInvestigador(\AppBundle\Entity\Investigador $investigador = null)
    {
        $this->investigador = $investigador;

        return $this;
    }

    /**
     * Get Investigador
     *
     * @return \AppBundle\Entity\Investigador
     */
    public function getInvestigador()
    {
        return $this->investigador;
    }

}
