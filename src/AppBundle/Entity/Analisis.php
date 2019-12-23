<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 07/07/2015
 * Time: 08:40:AM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File as File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="analisis")
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class Analisis {

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
    protected $nombre;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $formula;

    /**
     * @ORM\OneToMany(targetEntity="AnalisisMuestra", mappedBy="analisis")
     */
    protected $analisisMuestras;

    /**
     * @ORM\OneToMany(targetEntity="AnalisisReactivo", mappedBy="analisis")
     */
    protected $analisisReactivos;

    /**
     * @ORM\OneToMany(targetEntity="Campo", mappedBy="analisis", cascade={"persist"})
     */
    protected $campos;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="analisis_doc", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }


    public function __construct(){
        $this->analisisMuestras = new ArrayCollection();
        $this->analisisReactivos = new ArrayCollection();
        $this->campos = new ArrayCollection();
    }

    public function __toString(){
        return $this->getNombre();
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
     * Set Nombre
     *
     * @param string $nombre
     * @return Analisis
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
     * Set Formula
     *
     * @param string $formula
     * @return Analisis
     */
    public function setFormula($formula)
    {
        $this->formula = $formula;

        return $this;
    }

    /**
     * Get Formula
     *
     * @return string 
     */
    public function getFormula()
    {
        return $this->formula;
    }

    /**
     * Add AnalisisMuestras
     *
     * @param \AppBundle\Entity\AnalisisMuestra $analisisMuestras
     * @return Analisis
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

    /**
     * Add AnalisisReactivos
     *
     * @param \AppBundle\Entity\AnalisisReactivo $analisisReactivos
     * @return Analisis
     */
    public function addAnalisisReactivo(\AppBundle\Entity\AnalisisReactivo $analisisReactivos)
    {
        $this->analisisReactivos[] = $analisisReactivos;

        return $this;
    }

    /**
     * Remove AnalisisReactivos
     *
     * @param \AppBundle\Entity\AnalisisReactivo $analisisReactivos
     */
    public function removeAnalisisReactivo(\AppBundle\Entity\AnalisisReactivo $analisisReactivos)
    {
        $this->analisisReactivos->removeElement($analisisReactivos);
    }

    /**
     * Get AnalisisReactivos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnalisisReactivos()
    {
        return $this->analisisReactivos;
    }

    /**
     * Add Campos
     *
     * @param \AppBundle\Entity\Campo $campo
     * @return Analisis
     */
    public function addCampo(\AppBundle\Entity\Campo $campo)
    {
        $campo->addAnalisis($this);
        $this->campos->add($campo);
        return $this;
    }

    /**
     * Remove Campos
     *
     * @param \AppBundle\Entity\Campo $campos
     */
    public function removeCampo(\AppBundle\Entity\Campo $campos)
    {
        $this->campos->removeElement($campos);
    }

    /**
     * Get Campos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCampos()
    {
        return $this->campos;
    }
}
