<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210529094808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_169E6FB95280D160DB253253 ON course');
        $this->addSql('CREATE FULLTEXT INDEX IDX_169E6FB9DB253253 ON course (numcourse)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_169E6FB9DB253253 ON course');
        $this->addSql('CREATE FULLTEXT INDEX IDX_169E6FB95280D160DB253253 ON course (namecourse, numcourse)');
    }
}
