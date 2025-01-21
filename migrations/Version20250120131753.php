<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120131753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chapter_user (chapter_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A162A2DC579F4768 (chapter_id), INDEX IDX_A162A2DCA76ED395 (user_id), PRIMARY KEY(chapter_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chapter_user ADD CONSTRAINT FK_A162A2DC579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chapter_user ADD CONSTRAINT FK_A162A2DCA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_chapter DROP FOREIGN KEY FK_A18CAB2479F37AE5');
        $this->addSql('ALTER TABLE user_chapter_chapter DROP FOREIGN KEY FK_916CDDEEF0F88184');
        $this->addSql('ALTER TABLE user_chapter_chapter DROP FOREIGN KEY FK_916CDDEE579F4768');
        $this->addSql('DROP TABLE user_chapter');
        $this->addSql('DROP TABLE user_chapter_chapter');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_chapter (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, user_chapter_signup_date DATETIME NOT NULL, user_chapter_ended SMALLINT NOT NULL, INDEX IDX_A18CAB2479F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_chapter_chapter (user_chapter_id INT NOT NULL, chapter_id INT NOT NULL, INDEX IDX_916CDDEEF0F88184 (user_chapter_id), INDEX IDX_916CDDEE579F4768 (chapter_id), PRIMARY KEY(user_chapter_id, chapter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_chapter ADD CONSTRAINT FK_A18CAB2479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_chapter_chapter ADD CONSTRAINT FK_916CDDEEF0F88184 FOREIGN KEY (user_chapter_id) REFERENCES user_chapter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_chapter_chapter ADD CONSTRAINT FK_916CDDEE579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chapter_user DROP FOREIGN KEY FK_A162A2DC579F4768');
        $this->addSql('ALTER TABLE chapter_user DROP FOREIGN KEY FK_A162A2DCA76ED395');
        $this->addSql('DROP TABLE chapter_user');
    }
}
