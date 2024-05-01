<?php

namespace App\Form;

use App\Entity\Extension;
use App\Entity\Langue;
use App\Entity\TypeExtension;
use App\Repository\TypeExtensionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ExtensionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('apkFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'download_label' => 'Télécharger',
                'asset_helper' => true,
                'label' => 'Fichier APK',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('type', EntityType::class, [
                'class' => TypeExtension::class,
                'choice_label' => 'titre', // Champ à afficher dans la liste déroulante
                'multiple' => true, // Choix multiple
                'expanded' => true, // Liste déroulante
                'placeholder' => 'Sélectionnez un type...',
                'mapped' => false, // Ne pas mapper ce champ à l'entité
                'query_builder' => function (TypeExtensionRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.titre', 'ASC'); // Tri par ordre alphabétique
                },
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('langue', LanguageType::class, [
                'label' => 'Langue',
                'choice_translation_locale' => null,
                'alpha3' => false,
                'choice_self_translation' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Extension::class,
        ]);
    }
}
