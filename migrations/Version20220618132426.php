<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220618132426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD82EA2E54');
        $this->addSql('DROP INDEX IDX_D34A04AD82EA2E54 ON product');
        $this->addSql('ALTER TABLE product ADD gestionnaire_id INT NOT NULL, DROP commande_id');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD6885AC1B ON product (gestionnaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD6885AC1B');
        $this->addSql('DROP INDEX IDX_D34A04AD6885AC1B ON product');
        $this->addSql('ALTER TABLE product ADD commande_id INT DEFAULT NULL, DROP gestionnaire_id');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD82EA2E54 ON product (commande_id)');
    }
}
