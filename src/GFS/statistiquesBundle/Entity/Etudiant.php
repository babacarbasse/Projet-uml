<?php

namespace GFS\statistiquesBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="GFS\statistiquesBundle\Repository\EtudiantRepository")
 */
class Etudiant
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
     * @var string
     * @ORM\Column(name="prenom", type="string", length=45)
     */
    private $prenom;

    /**
     * @var \DateTime
     * @ORM\Column(name="ddn", type="date")
     */
    private $ddn;

    /**
     * @var string
     * @ORM\Column(name="lieuNaiss", type="string", length=75)
     */
    private $lieunaiss;

    /**
     * @var string
     * @ORM\Column(name="paysNaiss", type="string", length=75)
     */
    private $paysNaiss;

    /**
     * @var string
     * @ORM\Column(name="cin", type="string", length=15, unique=true)
     */
    private $cin;

    /**
     * @var string
     * @ORM\Column(name="tel", type="string", length=15, unique=true)
     */
    private $tel;

    /**
     * @var string
     * @ORM\Column(name="serieBac", type="string", length=4)
     */
    private $serieBac;

    /**
     * @var string
     * @ORM\Column(name="sexe", type="string", length=10)
     */
    private $sexe;

    /**
     * @var string
     * @ORM\Column(name="numero", type="string", length=10, unique=true)
     */
    private $num;

    /**
     * @var string
     * @ORM\Column(name="nature", type="string", length=5)
     */
    private $nature;


    /**
     * @var string
     * @ORM\Column(name="nationalite", type="string", length=45)
     */
    private $nationalite;

    /**
     * @var string
     * @ORM\Column(name="statut", type="string", length=10)
     */
    private $statut;
    
    /**
     * @ORM\ManyToOne(targetEntity="GFS\statistiquesBundle\Entity\Formation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formation;
    
    private $departement;
    
    private $option;
    
    private $niveau;
    
    private $anneeAcademique;
     
    private $resultat;
    
    private $dateInscrit;
    
    public function getDepartement() {
        return $this->departement;
    }
    public function setDepartement($departement) {
        $this->departement = $departement;
    }
    
    public function getOption() {
        return $this->option;
    }
    public function setOption($option) {
        $this->option = $option;
    }
    
    public function getNiveau() {
        return $this->niveau;
    }
    public function setNiveau($niveau) {
        $this->niveau = $niveau;
    }
    
    public function getAnneeAcademique() {
        return $this->anneeAcademique;
    }
    public function setAnneeAcademique($anneeAcademique) {
        $this->anneeAcademique = $anneeAcademique;
    }
    
    public function getResultat() {
        return $this->resultat;
    }
    public function setResultat($resultat) {
        $this->resultat = $resultat;
    }
    
    public function getDateInscrit() {
        return $this->dateInscrit;
    }
    public function setDateInscrit($dateInscrit) {
        $this->dateInscrit = $dateInscrit;
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
     * @return Etudiant
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Etudiant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set ddn
     *
     * @param \DateTime $ddn
     *
     * @return Etudiant
     */
    public function setDdn($ddn)
    {
        $this->ddn = $ddn;

        return $this;
    }

    /**
     * Get ddn
     *
     * @return \DateTime
     */
    public function getDdn()
    {
        return $this->ddn;
    }

    /**
     * Set lieunaiss
     *
     * @param string $lieunaiss
     *
     * @return Etudiant
     */
    public function setLieunaiss($lieunaiss)
    {
        $this->lieunaiss = $lieunaiss;

        return $this;
    }

    /**
     * Get lieunaiss
     *
     * @return string
     */
    public function getLieunaiss()
    {
        return $this->lieunaiss;
    }

    /**
     * Set paysNaiss
     *
     * @param string $paysNaiss
     *
     * @return Etudiant
     */
    public function setPaysNaiss($paysNaiss)
    {
        $this->paysNaiss = $paysNaiss;

        return $this;
    }

    /**
     * Get paysNaiss
     *
     * @return string
     */
    public function getPaysNaiss()
    {
        return $this->paysNaiss;
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return Etudiant
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Etudiant
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set serieBac
     *
     * @param string $serieBac
     *
     * @return Etudiant
     */
    public function setSerieBac($serieBac)
    {
        $this->serieBac = $serieBac;

        return $this;
    }

    /**
     * Get serieBac
     *
     * @return string
     */
    public function getSerieBac()
    {
        return $this->serieBac;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Etudiant
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set num
     *
     * @param string $num
     *
     * @return Etudiant
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set nature
     *
     * @param string $nature
     *
     * @return Etudiant
     */
    public function setNature($nature)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * Get nature
     *
     * @return string
     */
    public function getNature()
    {
        return $this->nature;
    }

    
    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Etudiant
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Etudiant
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set formation
     *
     * @param \GFS\statistiquesBundle\Entity\Formation $formation
     *
     * @return Etudiant
     */
    public function setFormation(\GFS\statistiquesBundle\Entity\Formation $formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return \GFS\statistiquesBundle\Entity\Formation
     */
    public function getFormation()
    {
        return $this->formation;
    }
    
    public function getDdnToStr() {
        $date = date_format($this->getDdn(),"d/m/Y");
        return $date;
    }
    
}
