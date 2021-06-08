<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515123604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_6D28840DCB944F1A ON payment (student_id)');
        $this->addSql('ALTER TABLE studentdetaill ADD student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE studentdetaill ADD CONSTRAINT FK_882B397CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_882B397CCB944F1A ON studentdetaill (student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DCB944F1A');
        $this->addSql('DROP INDEX IDX_6D28840DCB944F1A ON payment');
        $this->addSql('ALTER TABLE payment DROP student_id');
        $this->addSql('ALTER TABLE studentdetaill DROP FOREIGN KEY FK_882B397CCB944F1A');
        $this->addSql('DROP INDEX IDX_882B397CCB944F1A ON studentdetaill');
        $this->addSql('ALTER TABLE studentdetaill DROP student_id');
    }
}
