<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714231821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_taille ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_taille ADD CONSTRAINT FK_5587E0004584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_5587E0004584665A ON type_taille (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_taille DROP FOREIGN KEY FK_5587E0004584665A');
        $this->addSql('DROP INDEX IDX_5587E0004584665A ON type_taille');
        $this->addSql('ALTER TABLE type_taille DROP product_id');
    }
}
