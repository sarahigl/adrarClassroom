<?php

namespace App\Controller\Admin;

use App\Entity\Chapter;
use App\Entity\Course;
use App\Entity\Language;
use App\Entity\Level;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class CourseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Course::class;
    }

    public function configureFields(string $pageName): iterable
    {
       
            yield IdField::new('id')->hideOnForm()->hideOnIndex();
          
            yield AssociationField::new('chapter')
                 ->setQueryBuilder( 
                    fn(ORMQueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Chapter::class)->findAll() 
                 );
            yield TextField::new('course_title');
            yield IntegerField::new('course_estimation_time');
            yield AssociationField::new('id_level')
                 ->setQueryBuilder( 
                    fn(ORMQueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Level::class)->findAll() 
                 );
            yield AssociationField::new('id_language')
                 ->setQueryBuilder( 
                    fn(ORMQueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Language::class)->findAll() 
                 )->hideOnIndex();
            yield TextareaField::new('course_synopsis');
            yield IntegerField::new('courses_created')->hideOnIndex();
            yield DateField::new('course_date');
            yield ImageField::new('course_img')->setUploadDir('assets/images/')->hideOnIndex();
    }
}
