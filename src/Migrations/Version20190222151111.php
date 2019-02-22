<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190222151111 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT DEFAULT NULL, id_evenement_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) DEFAULT NULL, email VARCHAR(150) DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_postale INT DEFAULT NULL, statut TINYINT(1) DEFAULT NULL, INDEX IDX_4C62E6389F34925F (id_categorie_id), INDEX IDX_4C62E6382C115A61 (id_evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_organisation (contact_id INT NOT NULL, organisation_id INT NOT NULL, INDEX IDX_CA560080E7A1254A (contact_id), INDEX IDX_CA5600809E6B1585 (organisation_id), PRIMARY KEY(contact_id, organisation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6389F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6382C115A61 FOREIGN KEY (id_evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE contact_organisation ADD CONSTRAINT FK_CA560080E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_organisation ADD CONSTRAINT FK_CA5600809E6B1585 FOREIGN KEY (organisation_id) REFERENCES organisation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact_organisation DROP FOREIGN KEY FK_CA560080E7A1254A');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contact_organisation');
    }
}
