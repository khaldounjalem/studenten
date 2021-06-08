<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515105350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course_studentdetaill (course_id INT NOT NULL, studentdetaill_id INT NOT NULL, INDEX IDX_77E7DE48591CC992 (course_id), INDEX IDX_77E7DE4899922076 (studentdetaill_id), PRIMARY KEY(course_id, studentdetaill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE studentdetaill (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, INDEX IDX_882B397CCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_studentdetaill ADD CONSTRAINT FK_77E7DE48591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_studentdetaill ADD CONSTRAINT FK_77E7DE4899922076 FOREIGN KEY (studentdetaill_id) REFERENCES studentdetaill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE studentdetaill ADD CONSTRAINT FK_882B397CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE payment ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_6D28840DCB944F1A ON payment (student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course_studentdetaill DROP FOREIGN KEY FK_77E7DE4899922076');
        $this->addSql('DROP TABLE course_studentdetaill');
        $this->addSql('DROP TABLE studentdetaill');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DCB944F1A');
        $this->addSql('DROP INDEX IDX_6D28840DCB944F1A ON payment');
        $this->addSql('ALTER TABLE payment DROP student_id');
    }
}
