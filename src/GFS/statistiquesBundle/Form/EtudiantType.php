<?php

namespace GFS\statistiquesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EtudiantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('nom', TextType::class, array(
                'label' => 'Nom',
                'required'    => true
                ))
            ->add('prenom', TextType::class, array(
                'label' => 'Prénom',
                'required'    => true
                ))
            ->add('ddn', DateType::class, array(
                'label' => 'Date de naissance',
                'required'    => true,
                'years' => range(date('Y')-52, date('Y')-17)
                ))
            ->add('lieunaiss', TextareaType::class, array(
                'label' => 'Lieu de naissance',
                'required'    => true
                ))
            ->add('paysNaiss', CountryType::class, array(
                'label' => 'Pays de naissance',
                'required'    => true
                ))
            ->add('cin', TextType::class, array(
                'label' => 'Code Identification National',
                'required'    => true
                ))
            ->add('tel', TextType::class, array(
                'label' => 'Téléphone',
                'required'    => true
                ))
            ->add('serieBac', ChoiceType::class, array(
                'choices' => array(
                    'S1' => 's1',
                    'S2' => 's2',
                    'S3' => 's3',
                    'T' => 'T',
                    'L\'' => 'l\'',
                    'L2' => 'l2',
                ),
                'required'    => true,
                'label' => 'Série Bac'
                ))
            ->add('Sexe', ChoiceType::class, array(
                'choices' => array(
                    'Masculin' => 'masculin',
                    'Féminin' => 'féminin'
                ),
                'required'    => true
                ))
            ->add('num', TextType::class, array(
                'label' => 'Numéro Etudiant',
                'required'    => true
                ))
            ->add('nature', ChoiceType::class, array(
                'choices' => array(
                    'Jour' => 'jour',
                    'Nuit' => 'nuit'
                ),
                'required'    => true
                ))
            ->add('nationalite', EntityType::class, array(
                'label' => 'Nationalité',
                'class' => 'GFSstatistiquesBundle:Nationalite',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('n')
                        ->orderBy('n.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'required'    => true,
                'empty_data'  => false
              ))
            ->add('statut', ChoiceType::class, array(
                'choices' => array(
                    'Privé' => 'prive',
                    'Public' => 'public'
                    ),
                'required'    => true,
                'empty_data'  => false,
                ))
            ->add('departement', EntityType::class, array(
                'label' => 'Département',
                'class' => 'GFSstatistiquesBundle:Departement',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('d')
                        ->orderBy('d.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'required'    => true,
                'empty_data'  => false
              ))
            ->add('option', ChoiceType::class, array(
                'label' => 'Option',
                'required'    => true,
                'empty_data'  => false,
                'choices' => array(
                    '[[option.nom]]' => '[[option.id]]',
                    ),
                    'choice_attr' => function() {
                        return ['ng-repeat' => 'option in listeOption'];
                    }
                ))
            ->add('formation', ChoiceType::class, array(
                'label' => 'Formation',
                'required'    => true,
                'empty_data'  => false,
                'choices' => array(
                    '[[formation.nom]]' => '[[formation.id]]',
                    ),
                    'choice_attr' => function() {
                        return ['ng-repeat' => 'formation in listeFormations'];
                    }
                ))
            ->add('niveau', EntityType::class, array(
                'label' => 'Niveau',
                'class' => 'GFSstatistiquesBundle:Niveau',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('n')
                        ->orderBy('n.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'required'    => true,
                'empty_data'  => false
              ))
            ->add('dateInscrit', DateType::class, array(
                'label' => 'Date Inscription',
                'required'    => true,
                'years' => range(date('Y')-52, date('Y'))
                ))
            ->add('anneeAcademique', TextType::class, array(
                'label' => 'Année Académique. Ex (2016-2017)',
                'required'    => true
                ))
            ->add('resultat', ChoiceType::class, array(
                'choices' => array(
                    'Année en cours' => 'annee en cours',
                    'Passe' => 'passe',
                    'Redouble' => 'redouble',
                    'Abandon' => 'abandon',
                    'Exclu' => 'exclu'
                    ),
                'required'    => true,
                'empty_data'  => false
                ))
            ->add('save', SubmitType::class, array('label' => 'Ajouter etudiant'))
            ;  
    }
    
    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GFS\statistiquesBundle\Entity\Etudiant',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gfs_statistiquesbundle_etudiant';
    }


}
