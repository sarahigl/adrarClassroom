<?php

namespace App\Controller\Admin;

use App\Entity\Chapter;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use phpDocumentor\Reflection\Types\Integer;

class ChapterCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Chapter::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm()->hideOnIndex();
        yield TextField::new('chapter_title');
        yield IntegerField::new('chapter_position');
    }
}
/*      --affichage par chapitre (groupement)--
erreur getContainer() qui remplace getDoctrine deprecated
        $entityManager = $this->getContainer()->get(EntityManagerInterface::class);
        $repository = $entityManager->getRepository(Chapter::class);
        $chapters = $repository->findAll();
        $choice = [];

        foreach ($chapters as $chapter){
            $positionTitle = $chapter->getChapterPosition()?->getChapterTitle();
            if ($positionTitle) {
                $choice[$positionTitle][$chapter->getChapterTitle()]=$chapter;
            }
            
        }
        $fields[] = ChoiceField::new('chapter_position')
            ->setChoices($choice);

            */