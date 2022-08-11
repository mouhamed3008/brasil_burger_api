<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220721123757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu ADD menu_id INT DEFAULT NULL, ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93CCD7E912 FOREIGN KEY (menu_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A934584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_7D053A93CCD7E912 ON menu (menu_id)');
        $this->addSql('CREATE INDEX IDX_7D053A934584665A ON menu (product_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCCD7E912');
        $this->addSql('DROP INDEX IDX_D34A04ADCCD7E912 ON product');
        $this->addSql('ALTER TABLE product DROP menu_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93CCD7E912');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A934584665A');
        $this->addSql('DROP INDEX IDX_7D053A93CCD7E912 ON menu');
        $this->addSql('DROP INDEX IDX_7D053A934584665A ON menu');
        $this->addSql('ALTER TABLE menu DROP menu_id, DROP product_id');
        $this->addSql('ALTER TABLE product ADD menu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADCCD7E912 ON product (menu_id)');
    }
}
