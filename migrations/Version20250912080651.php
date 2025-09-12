<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250912080651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supplier_offer ADD supplier_id INT NOT NULL');
        $this->addSql('ALTER TABLE supplier_offer ADD CONSTRAINT FK_F0CD85142ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('CREATE INDEX IDX_F0CD85142ADD6D8C ON supplier_offer (supplier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE supplier_offer DROP FOREIGN KEY FK_F0CD85142ADD6D8C');
        $this->addSql('DROP INDEX IDX_F0CD85142ADD6D8C ON supplier_offer');
        $this->addSql('ALTER TABLE supplier_offer DROP supplier_id');
    }
}
