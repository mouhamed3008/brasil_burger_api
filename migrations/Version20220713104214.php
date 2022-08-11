<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713104214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_taille (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, taille_id INT DEFAULT NULL, stock INT DEFAULT NULL, INDEX IDX_5587E000C54C8C93 (type_id), INDEX IDX_5587E000FF25611A (taille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_taille ADD CONSTRAINT FK_5587E000C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE type_taille ADD CONSTRAINT FK_5587E000FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE product DROP stock');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_taille DROP FOREIGN KEY FK_5587E000FF25611A');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE type_taille');
        $this->addSql('ALTER TABLE product ADD stock INT DEFAULT NULL');
    }
}
