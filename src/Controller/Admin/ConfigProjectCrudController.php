<?php

namespace App\Controller\Admin;

use App\Entity\ConfigProject;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ConfigProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConfigProject::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', '#')
            ->hideOnForm();
        yield TextField::new('title', 'Title project');
        yield TextField::new('shorttext', 'Short text')
            ->hideOnIndex();
        yield EmailField::new('email', 'Email')
            ->hideOnIndex();
        yield TelephoneField::new('phone', 'Telephone')
            ->hideOnIndex();
        yield FormField::addPanel('Add logo');
        yield ImageField::new('photo', 'Logo')
            ->setColumns(3)
            ->onlyOnIndex()
            ->setBasePath($this->getParameter('app.logo_project'));
        yield TextareaField::new('imageFile', 'Logo')
            ->hideOnIndex()
            ->setHelp('Photo required')
            ->setFormTypeOptions([
                'allow_delete' => false,
            ])
            ->setFormType(VichImageType::class);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setEntityLabelInSingular('Project information')
            ->setEntityLabelInPlural('Information for the site (phone, email, logo...');
    }
}
