<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714114037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93734B8089');
        $this->addSql('DROP INDEX IDX_7D053A93734B8089 ON menu');
        $this->addSql('ALTER TABLE menu DROP boisson_id, DROP qty_b');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu ADD boisson_id INT DEFAULT NULL, ADD qty_b INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93734B8089 FOREIGN KEY (boisson_id) REFERENCES taille (id)');
        $this->addSql('CREATE INDEX IDX_7D053A93734B8089 ON menu (boisson_id)');
    }
}
