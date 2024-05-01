<?php

namespace App\Controller\Admin;

use App\Entity\Extension;
use App\Entity\TypeExtension;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\LanguageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\EntityFilterType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ExtensionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Extension::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('apkFile', 'Fichier APK')->setFormType(VichFileType::class, [
                'required' => true,
                'allow_delete' => true,
                'download_uri' => true,
                'download_label' => 'Télécharger',
                'asset_helper' => true,
                'attr' => [
                    'class' => 'form-control'
                ]

            ]),
            AssociationField::new('type')
                ->autocomplete()
                ->setFormTypeOptions([
                    'class' => TypeExtension::class,
                    'multiple' => true,

                ])
                ->setCustomOption('allowAdd', true)
                ->setCustomOption('allowDelete', true)
                ->setCustomOption('allowEdit', true)
                ->setCustomOption('sortable', true)
                ->setRequired(true) // Si la sélection du type est obligatoire
                ->setHelp('Sélectionnez le ou les types associés à cette extension.')
            ,

            LanguageField::new('langue')->showCode(true),
        ];
    }

}
