<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190301150833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE organisation ADD categorie_id INT DEFAULT NULL, DROP type');
        $this->addSql('ALTER TABLE organisation ADD CONSTRAINT FK_E6E132B4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_E6E132B4BCF5E72D ON organisation (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE organisation DROP FOREIGN KEY FK_E6E132B4BCF5E72D');
        $this->addSql('DROP INDEX IDX_E6E132B4BCF5E72D ON organisation');
        $this->addSql('ALTER TABLE organisation ADD type VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP categorie_id');
    }
}
