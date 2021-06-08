<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210523065835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_B723AF3383A00E683124B5B6 ON student');
        $this->addSql('ALTER TABLE student ADD dateofbirth DATE DEFAULT NULL, CHANGE placedateofbirth placeofbirth VARCHAR(255) NOT NULL');
        $this->addSql('CREATE FULLTEXT INDEX IDX_B723AF3383A00E683124B5B691657DAE450FF010 ON student (firstname, lastname, fullname, telephone)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_B723AF3383A00E683124B5B691657DAE450FF010 ON student');
        $this->addSql('ALTER TABLE student DROP dateofbirth, CHANGE placeofbirth placedateofbirth VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE FULLTEXT INDEX IDX_B723AF3383A00E683124B5B6 ON student (firstname, lastname)');
    }
}
