<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210529214203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE paymentstock');
        $this->addSql('DROP INDEX IDX_B723AF3391657DAE450FF010D92BA257F7311F08 ON student');
        $this->addSql('CREATE FULLTEXT INDEX IDX_B723AF3391657DAE450FF010D92BA257F7311F088B8E8428 ON student (fullname, telephone, dateofbirth, numstudent, created_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paymentstock (id INT AUTO_INCREMENT NOT NULL, amount INT NOT NULL, numpayment INT DEFAULT NULL, notes VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, student_id INT DEFAULT NULL, artcours VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, status TINYINT(1) DEFAULT NULL, INDEX IDX_6D28840DCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP INDEX IDX_B723AF3391657DAE450FF010D92BA257F7311F088B8E8428 ON student');
        $this->addSql('CREATE FULLTEXT INDEX IDX_B723AF3391657DAE450FF010D92BA257F7311F08 ON student (fullname, telephone, dateofbirth, numstudent)');
    }
}
