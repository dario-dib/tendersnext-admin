<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250912095240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD pharma_strength INT DEFAULT NULL, ADD pharma_dosage_form VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE supplier_offer ADD purchase_price DOUBLE PRECISION DEFAULT NULL, ADD purchase_price_valid_until DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supplier_offer DROP purchase_price, DROP purchase_price_valid_until');
        $this->addSql('ALTER TABLE product DROP pharma_strength, DROP pharma_dosage_form');
    }
}
