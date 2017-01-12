<?php

namespace GFS\statistiquesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NiveauEtudiant
 *
 * @ORM\Table(name="niveau_etudiant")
 * @ORM\Entity(repositoryClass="GFS\statistiquesBundle\Repository\NiveauEtudiantRepository")
 */
class NiveauEtudiant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="resultat", type="string", length=20)
     */
    private $resultat;

    /**
     * @var string
     * @ORM\Column(name="anneeAcademique", type="string", length=10)
     */
    private $anneeAcademique;
    
    /**
     * @var \DateTime
     * @ORM\Column(name="dateInscrit", type="date")
     */
    private $dateInscrit;

    
    /**
     * @ORM\ManyToOne(targetEntity="GFS\statistiquesBundle\Entity\Etudiant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudiant;
    
    /**
     * @ORM\ManyToOne(targetEntity="GFS\statistiquesBundle\Entity\Niveau")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;
    
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
     * Set resultat
     *
     * @param string $resultat
     *
     * @return NiveauEtudiant
     */
    public function setResultat($resultat)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat
     *
     * @return string
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set etudiant
     *
     * @param \GFS\statistiquesBundle\Entity\Etudiant $etudiant
     *
     * @return NiveauEtudiant
     */
    public function setEtudiant(\GFS\statistiquesBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * Get etudiant
     *
     * @return \GFS\statistiquesBundle\Entity\Etudiant
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * Set niveau
     *
     * @param \GFS\statistiquesBundle\Entity\Niveau $niveau
     *
     * @return NiveauEtudiant
     */
    public function setNiveau(\GFS\statistiquesBundle\Entity\Niveau $niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \GFS\statistiquesBundle\Entity\Niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set anneeAcademique
     *
     * @param string $anneeAcademique
     *
     * @return NiveauEtudiant
     */
    public function setAnneeAcademique($anneeAcademique)
    {
        $this->anneeAcademique = $anneeAcademique;

        return $this;
    }

    /**
     * Get anneeAcademique
     *
     * @return string
     */
    public function getAnneeAcademique()
    {
        return $this->anneeAcademique;
    }

    /**
     * Set dateInscrit
     *
     * @param \DateTime $dateInscrit
     *
     * @return NiveauEtudiant
     */
    public function setDateInscrit($dateInscrit)
    {
        $this->dateInscrit = $dateInscrit;

        return $this;
    }

    /**
     * Get dateInscrit
     *
     * @return \DateTime
     */
    public function getDateInscrit()
    {
        return $this->dateInscrit;
    }
}
