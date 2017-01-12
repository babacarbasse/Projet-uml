<?php

namespace GFS\statistiquesBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * OptionDep
 *
 * @ORM\Table(name="optionDep")
 * @ORM\Entity(repositoryClass="GFS\statistiquesBundle\Repository\OptionDepRepository")
 */
class OptionDep
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
     * @ORM\ManyToOne(targetEntity="GFS\statistiquesBundle\Entity\Departement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departement;
    
    public function __construct(\GFS\statistiquesBundle\Entity\Departement $departement, $nom) {
        $this->departement = $departement;
        $this->nom = $nom;
    }

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
     * @return OptionDep
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
     * Set departement
     *
     * @param \GFS\statistiquesBundle\Entity\Departement $departement
     *
     * @return OptionDep
     */
    public function setDepartement(\GFS\statistiquesBundle\Entity\Departement $departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \GFS\statistiquesBundle\Entity\Departement
     */
    public function getDepartement()
    {
        return $this->departement;
    }
    
    public function __toString(){
        return $this->getNom();
    }
}
