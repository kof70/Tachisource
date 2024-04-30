<?php

namespace App\Form;

use App\Entity\Extension;
use App\Entity\Langue;
use App\Entity\TypeExtension;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('type', CollectionType::class, [
                'entry_type' => EntityType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'entry_options' => [
                    'class' => TypeExtension::class,
                    'multiple' => true,
                    'expanded' => true,
                ],
                'attr' => [
                    'class' => 'form-control'
                ],

            ])
            ->add('langue', EntityType::class, [
                'class' => Langue::class,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Extension::class,
        ]);
    }
}
