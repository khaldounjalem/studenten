<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515125938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course_studentdetaill (course_id INT NOT NULL, studentdetaill_id INT NOT NULL, INDEX IDX_77E7DE48591CC992 (course_id), INDEX IDX_77E7DE4899922076 (studentdetaill_id), PRIMARY KEY(course_id, studentdetaill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_studentdetaill ADD CONSTRAINT FK_77E7DE48591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_studentdetaill ADD CONSTRAINT FK_77E7DE4899922076 FOREIGN KEY (studentdetaill_id) REFERENCES studentdetaill (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE course_studentdetaill');
    }
}
