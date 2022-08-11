<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714224742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93CCD7E912');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A934584665A');
        $this->addSql('DROP INDEX IDX_7D053A93CCD7E912 ON menu');
        $this->addSql('DROP INDEX IDX_7D053A934584665A ON menu');
        $this->addSql('ALTER TABLE menu ADD libelle VARCHAR(255) NOT NULL, ADD image LONGBLOB DEFAULT NULL, ADD is_active TINYINT(1) NOT NULL, DROP menu_id, DROP product_id, CHANGE qty_p prix INT NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD78C2BC47');
        $this->addSql('DROP INDEX IDX_D34A04AD78C2BC47 ON product');
        $this->addSql('ALTER TABLE product CHANGE variety_id type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADC54C8C93 ON product (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu ADD menu_id INT DEFAULT NULL, ADD product_id INT DEFAULT NULL, DROP libelle, DROP image, DROP is_active, CHANGE prix qty_p INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93CCD7E912 FOREIGN KEY (menu_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A934584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_7D053A93CCD7E912 ON menu (menu_id)');
        $this->addSql('CREATE INDEX IDX_7D053A934584665A ON menu (product_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('DROP INDEX IDX_D34A04ADC54C8C93 ON product');
        $this->addSql('ALTER TABLE product CHANGE type_id variety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD78C2BC47 FOREIGN KEY (variety_id) REFERENCES type_taille (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD78C2BC47 ON product (variety_id)');
    }
}
