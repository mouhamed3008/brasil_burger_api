<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702211728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_menu DROP FOREIGN KEY FK_16693B70CCD7E912');
        $this->addSql('ALTER TABLE menu_product DROP FOREIGN KEY FK_5B911913CCD7E912');
        $this->addSql('DROP TABLE commande_menu');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_product');
        $this->addSql('ALTER TABLE product DROP type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_menu (commande_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_16693B7082EA2E54 (commande_id), INDEX IDX_16693B70CCD7E912 (menu_id), PRIMARY KEY(commande_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menu (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menu_product (menu_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_5B911913CCD7E912 (menu_id), INDEX IDX_5B9119134584665A (product_id), PRIMARY KEY(menu_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_menu ADD CONSTRAINT FK_16693B70CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_menu ADD CONSTRAINT FK_16693B7082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93BF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_product ADD CONSTRAINT FK_5B911913CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_product ADD CONSTRAINT FK_5B9119134584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD type VARCHAR(255) NOT NULL');
    }
}
