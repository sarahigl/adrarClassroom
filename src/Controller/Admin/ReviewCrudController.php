<?php

namespace App\Controller\Admin;

use App\Entity\Review;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;

class ReviewCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Review::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
    public function configureFields(string $pageName): iterable
    {
       
            yield IdField::new('id')->hideOnIndex();
            yield TextField::new('review_content');
            yield AssociationField::new('id_user')
                 ->setQueryBuilder( 
                    fn(ORMQueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(User::class)->findAll() 
                 );
            
                
    }
}
