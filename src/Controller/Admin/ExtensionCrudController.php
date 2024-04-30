<?php

namespace App\Controller\Admin;

use App\Entity\Extension;
use App\Entity\TypeExtension;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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
            IntegerField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('apkFile', 'Fichier APK')->setFormType(VichFileType::class),
            CollectionField::new('type')->setFormTypeOptions([
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => TypeExtension::class,
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
            ]),
            LanguageField::new('langue')->showCode(true),
        ];
    }

}
