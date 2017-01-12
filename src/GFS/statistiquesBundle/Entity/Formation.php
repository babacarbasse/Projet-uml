<?php

namespace GFS\statistiquesBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="GFS\statistiquesBundle\Repository\FormationRepository")
 */

class Formation
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=45)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="GFS\statistiquesBundle\Entity\OptionDep")
     * @ORM\JoinColumn(nullable=false)
     */
    private $optionDep;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Formation
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set optionDep
     *
     * @param \GFS\statistiquesBundle\Entity\OptionDep $optionDep
     *
     * @return Formation
     */
    public function setOptionDep(\GFS\statistiquesBundle\Entity\OptionDep $optionDep)
    {
        $this->optionDep = $optionDep;

        return $this;
    }

    /**
     * Get optionDep
     *
     * @return \GFS\statistiquesBundle\Entity\OptionDep
     */
    public function getOptionDep()
    {
        return $this->optionDep;
    }
    public function __toString(){
        return $this->getNom();
    }
}
