<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210522123233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, namecourse VARCHAR(255) NOT NULL, numcourse INT DEFAULT NULL, numdetaillcourse INT DEFAULT NULL, startdate DATE DEFAULT NULL, day VARCHAR(255) DEFAULT NULL, time TIME DEFAULT NULL, teacher VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, enddate DATE DEFAULT NULL, numlessons INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_studentdetaill (course_id INT NOT NULL, studentdetaill_id INT NOT NULL, INDEX IDX_77E7DE48591CC992 (course_id), INDEX IDX_77E7DE4899922076 (studentdetaill_id), PRIMARY KEY(course_id, studentdetaill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, amount INT NOT NULL, numpayment INT DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_6D28840DCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, brochure_filename VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, fullname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) DEFAULT NULL, father VARCHAR(255) DEFAULT NULL, mother VARCHAR(255) DEFAULT NULL, placedateofbirth VARCHAR(255) NOT NULL, studying VARCHAR(255) DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, status TINYINT(1) NOT NULL, FULLTEXT INDEX IDX_B723AF3383A00E683124B5B6 (firstname, lastname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE studentdetaill (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, degree NUMERIC(10, 2) DEFAULT NULL, result VARCHAR(255) DEFAULT NULL, numpage INT DEFAULT NULL, numgeneral INT DEFAULT NULL, INDEX IDX_882B397CCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE course_studentdetaill ADD CONSTRAINT FK_77E7DE48591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_studentdetaill ADD CONSTRAINT FK_77E7DE4899922076 FOREIGN KEY (studentdetaill_id) REFERENCES studentdetaill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE studentdetaill ADD CONSTRAINT FK_882B397CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course_studentdetaill DROP FOREIGN KEY FK_77E7DE48591CC992');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DCB944F1A');
        $this->addSql('ALTER TABLE studentdetaill DROP FOREIGN KEY FK_882B397CCB944F1A');
        $this->addSql('ALTER TABLE course_studentdetaill DROP FOREIGN KEY FK_77E7DE4899922076');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_studentdetaill');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE studentdetaill');
        $this->addSql('DROP TABLE user');
    }
}
