<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714235836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD78C2BC47');
        $this->addSql('DROP INDEX IDX_D34A04AD78C2BC47 ON product');
        $this->addSql('ALTER TABLE product CHANGE variety_id type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADC54C8C93 ON product (type_id)');
        $this->addSql('ALTER TABLE type_taille DROP FOREIGN KEY FK_5587E000C54C8C93');
        $this->addSql('DROP INDEX IDX_5587E000C54C8C93 ON type_taille');
        $this->addSql('ALTER TABLE type_taille DROP type_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('DROP INDEX IDX_D34A04ADC54C8C93 ON product');
        $this->addSql('ALTER TABLE product CHANGE type_id variety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD78C2BC47 FOREIGN KEY (variety_id) REFERENCES type_taille (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD78C2BC47 ON product (variety_id)');
        $this->addSql('ALTER TABLE type_taille ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_taille ADD CONSTRAINT FK_5587E000C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_5587E000C54C8C93 ON type_taille (type_id)');
    }
}
