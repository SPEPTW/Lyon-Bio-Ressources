<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190225144031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6382C115A61');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6389F34925F');
        $this->addSql('DROP INDEX IDX_4C62E6389F34925F ON contact');
        $this->addSql('DROP INDEX IDX_4C62E6382C115A61 ON contact');
        $this->addSql('ALTER TABLE contact ADD categorie_id INT DEFAULT NULL, ADD evenement_id INT DEFAULT NULL, DROP id_categorie_id, DROP id_evenement_id');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638BCF5E72D ON contact (categorie_id)');
        $this->addSql('CREATE INDEX IDX_4C62E638FD02F13 ON contact (evenement_id)');
        $this->addSql('ALTER TABLE organisation CHANGE type type VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638BCF5E72D');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638FD02F13');
        $this->addSql('DROP INDEX IDX_4C62E638BCF5E72D ON contact');
        $this->addSql('DROP INDEX IDX_4C62E638FD02F13 ON contact');
        $this->addSql('ALTER TABLE contact ADD id_categorie_id INT DEFAULT NULL, ADD id_evenement_id INT DEFAULT NULL, DROP categorie_id, DROP evenement_id');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6382C115A61 FOREIGN KEY (id_evenement_id) REFERENCES evenement (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6389F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4C62E6389F34925F ON contact (id_categorie_id)');
        $this->addSql('CREATE INDEX IDX_4C62E6382C115A61 ON contact (id_evenement_id)');
        $this->addSql('ALTER TABLE organisation CHANGE type type INT DEFAULT NULL');
    }
}
