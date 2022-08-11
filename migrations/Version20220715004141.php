<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715004141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE components (id INT AUTO_INCREMENT NOT NULL, ligne_com_id INT DEFAULT NULL, boisson_id INT DEFAULT NULL, INDEX IDX_EE48F5FD52569371 (ligne_com_id), INDEX IDX_EE48F5FD734B8089 (boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE components ADD CONSTRAINT FK_EE48F5FD52569371 FOREIGN KEY (ligne_com_id) REFERENCES ligne_de_commande (id)');
        $this->addSql('ALTER TABLE components ADD CONSTRAINT FK_EE48F5FD734B8089 FOREIGN KEY (boisson_id) REFERENCES type_taille (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE components');
    }
}
