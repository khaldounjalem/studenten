<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515121744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE course_studentdetaill');
        $this->addSql('DROP TABLE studentdetill');
        $this->addSql('ALTER TABLE course CHANGE numdetaillcourse numdetaillcourse INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DCB944F1A');
        $this->addSql('DROP INDEX IDX_6D28840DCB944F1A ON payment');
        $this->addSql('ALTER TABLE payment DROP student_id');
        $this->addSql('ALTER TABLE studentdetaill DROP FOREIGN KEY FK_882B397CCB944F1A');
        $this->addSql('DROP INDEX IDX_882B397CCB944F1A ON studentdetaill');
        $this->addSql('ALTER TABLE studentdetaill ADD degree NUMERIC(10, 2) DEFAULT NULL, ADD result VARCHAR(255) DEFAULT NULL, ADD numgeneral INT DEFAULT NULL, CHANGE student_id numpage INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course_studentdetaill (course_id INT NOT NULL, studentdetaill_id INT NOT NULL, INDEX IDX_77E7DE48591CC992 (course_id), INDEX IDX_77E7DE4899922076 (studentdetaill_id), PRIMARY KEY(course_id, studentdetaill_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE studentdetill (id INT AUTO_INCREMENT NOT NULL, degree NUMERIC(10, 2) DEFAULT NULL, result VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, numpage INT DEFAULT NULL, numgeneral INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE course_studentdetaill ADD CONSTRAINT FK_77E7DE48591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_studentdetaill ADD CONSTRAINT FK_77E7DE4899922076 FOREIGN KEY (studentdetaill_id) REFERENCES studentdetaill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course CHANGE numdetaillcourse numdetaillcourse INT NOT NULL');
        $this->addSql('ALTER TABLE payment ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_6D28840DCB944F1A ON payment (student_id)');
        $this->addSql('ALTER TABLE studentdetaill ADD student_id INT DEFAULT NULL, DROP degree, DROP result, DROP numpage, DROP numgeneral');
        $this->addSql('ALTER TABLE studentdetaill ADD CONSTRAINT FK_882B397CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_882B397CCB944F1A ON studentdetaill (student_id)');
    }
}
