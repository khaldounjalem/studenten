<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210530081627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paymentstocks DROP FOREIGN KEY FK_8B86422BCB944F1A');
        $this->addSql('DROP INDEX IDX_8B86422BCB944F1A ON paymentstocks');
        $this->addSql('ALTER TABLE paymentstocks DROP student_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paymentstocks ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paymentstocks ADD CONSTRAINT FK_8B86422BCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_8B86422BCB944F1A ON paymentstocks (student_id)');
    }
}
