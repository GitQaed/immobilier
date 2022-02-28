<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224154839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE logement (id INT AUTO_INCREMENT NOT NULL, superficie INT DEFAULT NULL, ville VARCHAR(100) NOT NULL, prix INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logement_agence (logement_id INT NOT NULL, agence_id INT NOT NULL, INDEX IDX_D98B602258ABF955 (logement_id), INDEX IDX_D98B6022D725330D (agence_id), PRIMARY KEY(logement_id, agence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE logement_agence ADD CONSTRAINT FK_D98B602258ABF955 FOREIGN KEY (logement_id) REFERENCES logement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logement_agence ADD CONSTRAINT FK_D98B6022D725330D FOREIGN KEY (agence_id) REFERENCES agence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE logement_agence DROP FOREIGN KEY FK_D98B602258ABF955');
        $this->addSql('DROP TABLE logement');
        $this->addSql('DROP TABLE logement_agence');
        $this->addSql('ALTER TABLE agence CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE employe CHANGE prenom prenom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
