<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707105026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('DROP INDEX IDX_6EEAA67D8E54FB25 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE livraison_id livres_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DEBF07F38 FOREIGN KEY (livres_id) REFERENCES livraison (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DEBF07F38 ON commande (livres_id)');
        $this->addSql('ALTER TABLE product CHANGE gestionnaire_id gestionnaire_id INT NOT NULL, CHANGE image image LONGBLOB NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEBF07F38');
        $this->addSql('DROP INDEX IDX_6EEAA67DEBF07F38 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE livres_id livraison_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8E54FB25 ON commande (livraison_id)');
        $this->addSql('ALTER TABLE product CHANGE gestionnaire_id gestionnaire_id INT DEFAULT NULL, CHANGE image image LONGBLOB DEFAULT NULL');
    }
}
