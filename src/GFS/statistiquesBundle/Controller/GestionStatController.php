<?php
namespace GFS\statistiquesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use GFS\statistiquesBundle\Entity\Etudiant;
use GFS\statistiquesBundle\Entity\Niveau;
use GFS\statistiquesBundle\Entity\Formation;
use GFS\statistiquesBundle\Entity\NiveauEtudiant;
use GFS\statistiquesBundle\Form\EtudiantType;

class GestionStatController extends controller {
    
    public function listesAction() {
        ini_set('intl.default_locale', 'fr');
        
        $em = $this->getDoctrine()->getManager();
        $listeEtudiant = $em->getRepository('GFSstatistiquesBundle:Etudiant')->findAll();  
        $listeDepartement = $em->getRepository('GFSstatistiquesBundle:Departement')->findAll();  
        
        return $this->render('GFSstatistiquesBundle:Statistiques:indexStat.html.twig', array(
            'listeEtudiant'  => $listeEtudiant,
            'listeDepartement' => $listeDepartement
        ));
    }
    
    public function addDataAction(Request $request) {
        
        ini_set('intl.default_locale', 'fr');
        
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager(); 
            $rep = $em->getRepository('GFSstatistiquesBundle:Formation');
            $etudiant = $form->getData();
            $etudiant->setNationalite($form->getData()->getNationalite()->getNom());
            $formation = $rep->findOneBy(array('id' => $request->get('gfs_statistiquesbundle_etudiant')['formation']));
            $etudiant->setFormation($formation);
            $niveau = $etudiant->getNiveau();
            $anneeAca = $etudiant->getAnneeAcademique();
            $dateInscrit = $etudiant->getDateInscrit();
            $resultat = $etudiant->getResultat();
            $niveauEtudiant = new NiveauEtudiant();
            $niveauEtudiant
                ->setEtudiant($etudiant)
                ->setNiveau($niveau)
                ->setAnneeAcademique($anneeAca)
                ->setDateInscrit($dateInscrit)
                ->setResultat($resultat)
            ;
            $em->persist($etudiant);
            $em->persist($niveauEtudiant);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Etudiant bien ajouté !');
            return $this->redirectToRoute('gfs_statistiques_addData');
        }
        return $this->render('GFSstatistiquesBundle:Statistiques:addData.html.twig', array(
            'etudiantForm' => $form->createView(),
        ));
        
    }
    
    public function getOptionAtSelectedDeptAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $idDepartement = $data['idDepartement'];
        $departement = $em->getRepository('GFSstatistiquesBundle:Departement')->findOneBy(array('id' => $idDepartement));
        $listeOptions = $em->getRepository('GFSstatistiquesBundle:OptionDep')->getOptionAtSelectedDept($departement);
        return JsonResponse::create($listeOptions, 200)
        ->setSharedMaxAge(300);
    }
    
    public function getFormationAtOptionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $idOption = $data['idOption'];
        $option = $em->getRepository('GFSstatistiquesBundle:OptionDep')->findOneBy(array('id' => $idOption));
        $listeFormations = $em->getRepository('GFSstatistiquesBundle:Formation')->getFormationAtSelectedOption($option);
        return JsonResponse::create($listeFormations, 200)
        ->setSharedMaxAge(300);
    }
    
    public function globalStatistiqueAction() {
        $em = $this->getDoctrine()->getManager();
        $listeDepartement = $em->getRepository('GFSstatistiquesBundle:Departement')->getAllDepartement(); 
        
        return $this->render('GFSstatistiquesBundle:Statistiques:globalStat.html.twig',array(
            'listeDepartement' => $listeDepartement
        ));
    }
    
    public function getlAllDepartFormationAction() {
        $em = $this->getDoctrine()->getManager();
        $listeDepartement = $em->getRepository('GFSstatistiquesBundle:Departement')->getAllDepartement(); 
        $listeFormation = $em->getRepository('GFSstatistiquesBundle:Formation')->getAllFormation(); 
        $liste = array('listeDepartement' => $listeDepartement,
        'listeFormation' => $listeFormation);
        return JsonResponse::create($liste, 200)
        ->setSharedMaxAge(300);
    } 
    
    public function allEtudiantForStatAction() {
        $em = $this->getDoctrine()->getManager();
        $liste = $em->getRepository('GFSstatistiquesBundle:Etudiant')->getAllEtudiantForStat();
        return JsonResponse::create($liste, 200)->setSharedMaxAge(300);
    }
    
}
?>