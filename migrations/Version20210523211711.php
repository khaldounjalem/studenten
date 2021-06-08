<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210523211711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_B723AF3391657DAE450FF010D92BA257 ON student');
        $this->addSql('CREATE FULLTEXT INDEX IDX_B723AF3391657DAE450FF010D92BA257F7311F08 ON student (fullname, telephone, dateofbirth, numstudent)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_B723AF3391657DAE450FF010D92BA257F7311F08 ON student');
        $this->addSql('CREATE FULLTEXT INDEX IDX_B723AF3391657DAE450FF010D92BA257 ON student (fullname, telephone, dateofbirth)');
    }
}
