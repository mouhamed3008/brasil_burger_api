<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707104021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE livraison_zone');
        $this->addSql('ALTER TABLE commande ADD zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D9F2C3FAB ON commande (zone_id)');
        $this->addSql('ALTER TABLE product CHANGE gestionnaire_id gestionnaire_id INT NOT NULL, CHANGE image image LONGBLOB NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livraison_zone (livraison_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_B1AA3B68E54FB25 (livraison_id), INDEX IDX_B1AA3B69F2C3FAB (zone_id), PRIMARY KEY(livraison_id, zone_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livraison_zone ADD CONSTRAINT FK_B1AA3B69F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livraison_zone ADD CONSTRAINT FK_B1AA3B68E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D9F2C3FAB');
        $this->addSql('DROP INDEX IDX_6EEAA67D9F2C3FAB ON commande');
        $this->addSql('ALTER TABLE commande DROP zone_id');
    }
}
