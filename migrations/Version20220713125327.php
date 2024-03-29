<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713125327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE variety (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_taille ADD variety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_taille ADD CONSTRAINT FK_5587E00078C2BC47 FOREIGN KEY (variety_id) REFERENCES variety (id)');
        $this->addSql('CREATE INDEX IDX_5587E00078C2BC47 ON type_taille (variety_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_taille DROP FOREIGN KEY FK_5587E00078C2BC47');
        $this->addSql('DROP TABLE variety');
        $this->addSql('DROP INDEX IDX_5587E00078C2BC47 ON type_taille');
        $this->addSql('ALTER TABLE type_taille DROP variety_id');
    }
}
