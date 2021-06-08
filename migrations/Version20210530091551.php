<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210530091551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paymentstock CHANGE studentid student_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paymentstock ADD CONSTRAINT FK_3790B10FCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('CREATE INDEX IDX_3790B10FCB944F1A ON paymentstock (student_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paymentstock DROP FOREIGN KEY FK_3790B10FCB944F1A');
        $this->addSql('DROP INDEX IDX_3790B10FCB944F1A ON paymentstock');
        $this->addSql('ALTER TABLE paymentstock CHANGE student_id studentid INT DEFAULT NULL');
    }
}
