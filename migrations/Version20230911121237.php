<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230911121237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP montant_total, CHANGE statut reference VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE detail_commande ADD prix DOUBLE PRECISION NOT NULL, DROP prix_unitaire, DROP sous_total');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD montant_total DOUBLE PRECISION NOT NULL, CHANGE reference statut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE detail_commande ADD sous_total DOUBLE PRECISION NOT NULL, CHANGE prix prix_unitaire DOUBLE PRECISION NOT NULL');
    }
}
