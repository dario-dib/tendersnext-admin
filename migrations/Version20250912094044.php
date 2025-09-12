<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250912094044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pharma_active_ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_taxonomy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD product_taxonomy_id INT DEFAULT NULL, ADD pharma_active_ingredient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD397878E9 FOREIGN KEY (product_taxonomy_id) REFERENCES product_taxonomy (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEC50AB3C FOREIGN KEY (pharma_active_ingredient_id) REFERENCES pharma_active_ingredient (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD397878E9 ON product (product_taxonomy_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADEC50AB3C ON product (pharma_active_ingredient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEC50AB3C');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD397878E9');
        $this->addSql('DROP TABLE pharma_active_ingredient');
        $this->addSql('DROP TABLE product_taxonomy');
        $this->addSql('DROP INDEX IDX_D34A04AD397878E9 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADEC50AB3C ON product');
        $this->addSql('ALTER TABLE product DROP product_taxonomy_id, DROP pharma_active_ingredient_id');
    }
}
