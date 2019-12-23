<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 15:22
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="campo_analisis_valor")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CampoAnalisisValorRepository")
 */
class CampoAnalisisValor {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var decimal
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $valor;

    /**
     * @var CampoAnalisis
     * @ORM\ManyToOne(targetEntity="Campo", inversedBy="campoAnalisisValores")
     * @ORM\JoinColumn(name="campoId",referencedColumnName="id")
     */
    protected $campo;

    /**
     * @var AnalisisMuestra
     * @ORM\ManyToOne(targetEntity="AnalisisMuestra", inversedBy="valores", cascade= "persist")
     * @ORM\JoinColumn(name="analisisMuestraId",referencedColumnName="id")
     */
    protected $analisis;

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
     * Set Valor
     *
     * @param string $valor
     * @return CampoAnalisisValor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get Valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }


    /**
     * Set Campo
     *
     * @param \AppBundle\Entity\Campo $campo
     * @return CampoAnalisisValor
     */
    public function setCampo(\AppBundle\Entity\Campo $campo = null)
    {
        $this->campo = $campo;

        return $this;
    }

    /**
     * Get Campo
     *
     * @return \AppBundle\Entity\Campo 
     */
    public function getCampo()
    {
        return $this->campo;
    }

    /**
     * Set analisis
     *
     * @param \AppBundle\Entity\AnalisisMuestra $analisis
     * @return CampoAnalisisValor
     */
    public function setAnalisis(\AppBundle\Entity\AnalisisMuestra $analisis = null)
    {
        $this->analisis = $analisis;

        return $this;
    }

    /**
     * Get analisis
     *
     * @return \AppBundle\Entity\AnalisisMuestra 
     */
    public function getAnalisis()
    {
        return $this->analisis;
    }
}
