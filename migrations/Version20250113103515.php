<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250113103515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, chapter_title VARCHAR(50) NOT NULL, chapter_position INT NOT NULL, chapter_content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, chapter_id INT DEFAULT NULL, id_language_id INT DEFAULT NULL, id_level_id INT DEFAULT NULL, course_title VARCHAR(50) NOT NULL, course_synopsis VARCHAR(100) NOT NULL, course_level SMALLINT NOT NULL, course_estimation_time INT NOT NULL, course_img VARCHAR(100) NOT NULL, course_date DATE NOT NULL, courses_created SMALLINT NOT NULL, date_course DATE NOT NULL, INDEX IDX_169E6FB9579F4768 (chapter_id), INDEX IDX_169E6FB99AE37703 (id_language_id), INDEX IDX_169E6FB9F6AA732 (id_level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, language_label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, review_content LONGTEXT NOT NULL, INDEX IDX_794381C679F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, user_name VARCHAR(50) DEFAULT NULL, lastname_user VARCHAR(50) DEFAULT NULL, user_image VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_chapter (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, user_chapter_signup_date DATETIME NOT NULL, user_chapter_ended SMALLINT NOT NULL, INDEX IDX_A18CAB2479F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_chapter_chapter (user_chapter_id INT NOT NULL, chapter_id INT NOT NULL, INDEX IDX_916CDDEEF0F88184 (user_chapter_id), INDEX IDX_916CDDEE579F4768 (chapter_id), PRIMARY KEY(user_chapter_id, chapter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB99AE37703 FOREIGN KEY (id_language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9F6AA732 FOREIGN KEY (id_level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C679F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_chapter ADD CONSTRAINT FK_A18CAB2479F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_chapter_chapter ADD CONSTRAINT FK_916CDDEEF0F88184 FOREIGN KEY (user_chapter_id) REFERENCES user_chapter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_chapter_chapter ADD CONSTRAINT FK_916CDDEE579F4768 FOREIGN KEY (chapter_id) REFERENCES chapter (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9579F4768');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB99AE37703');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9F6AA732');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C679F37AE5');
        $this->addSql('ALTER TABLE user_chapter DROP FOREIGN KEY FK_A18CAB2479F37AE5');
        $this->addSql('ALTER TABLE user_chapter_chapter DROP FOREIGN KEY FK_916CDDEEF0F88184');
        $this->addSql('ALTER TABLE user_chapter_chapter DROP FOREIGN KEY FK_916CDDEE579F4768');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_chapter');
        $this->addSql('DROP TABLE user_chapter_chapter');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
