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
 * @ORM\Entity()
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
}
