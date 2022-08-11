<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714231601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_taille DROP FOREIGN KEY FK_5587E000FF25611A');
        $this->addSql('DROP TABLE taille');
        $this->addSql('ALTER TABLE menu ADD produits_id INT DEFAULT NULL, ADD menus_id INT DEFAULT NULL, DROP libelle, DROP image, DROP is_active, CHANGE prix quantity INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93CD11A2CF FOREIGN KEY (produits_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9314041B84 FOREIGN KEY (menus_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_7D053A93CD11A2CF ON menu (produits_id)');
        $this->addSql('CREATE INDEX IDX_7D053A9314041B84 ON menu (menus_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADC54C8C93');
        $this->addSql('DROP INDEX IDX_D34A04ADC54C8C93 ON product');
        $this->addSql('ALTER TABLE product CHANGE type_id variety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD78C2BC47 FOREIGN KEY (variety_id) REFERENCES type_taille (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD78C2BC47 ON product (variety_id)');
        $this->addSql('DROP INDEX IDX_5587E000FF25611A ON type_taille');
        $this->addSql('ALTER TABLE type_taille DROP taille_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93CD11A2CF');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9314041B84');
        $this->addSql('DROP INDEX IDX_7D053A93CD11A2CF ON menu');
        $this->addSql('DROP INDEX IDX_7D053A9314041B84 ON menu');
        $this->addSql('ALTER TABLE menu ADD libelle VARCHAR(255) NOT NULL, ADD image LONGBLOB DEFAULT NULL, ADD is_active TINYINT(1) NOT NULL, DROP produits_id, DROP menus_id, CHANGE quantity prix INT NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD78C2BC47');
        $this->addSql('DROP INDEX IDX_D34A04AD78C2BC47 ON product');
        $this->addSql('ALTER TABLE product CHANGE variety_id type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADC54C8C93 ON product (type_id)');
        $this->addSql('ALTER TABLE type_taille ADD taille_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_taille ADD CONSTRAINT FK_5587E000FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('CREATE INDEX IDX_5587E000FF25611A ON type_taille (taille_id)');
    }
}
