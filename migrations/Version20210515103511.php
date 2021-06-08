<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515103511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, namecourse VARCHAR(255) NOT NULL, numcourse INT DEFAULT NULL, numdetaillcourse INT NOT NULL, startdate DATE DEFAULT NULL, day VARCHAR(255) DEFAULT NULL, time TIME DEFAULT NULL, teacher VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, enddate DATE DEFAULT NULL, numlessons INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, amount INT NOT NULL, datepayment DATE DEFAULT NULL, numpayment INT DEFAULT NULL, notes VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE studentdetill (id INT AUTO_INCREMENT NOT NULL, degree NUMERIC(10, 2) DEFAULT NULL, result VARCHAR(255) DEFAULT NULL, numpage INT DEFAULT NULL, numgeneral INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX idx_8f0f589d83a00e683124b5b6 ON student');
        $this->addSql('CREATE FULLTEXT INDEX IDX_B723AF3383A00E683124B5B6 ON student (firstname, lastname)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE studentdetill');
        $this->addSql('DROP INDEX idx_b723af3383a00e683124b5b6 ON student');
        $this->addSql('CREATE FULLTEXT INDEX IDX_8F0F589D83A00E683124B5B6 ON student (firstname, lastname)');
    }
}
