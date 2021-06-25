<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210625150207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE counter_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE counter_update_log_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE counter_entity (id INT NOT NULL, count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE counter_update_log_entity (id INT NOT NULL, counter_id INT DEFAULT NULL, timestamp VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E7F0821EFCEEF2E3 ON counter_update_log_entity (counter_id)');
        $this->addSql('ALTER TABLE counter_update_log_entity ADD CONSTRAINT FK_E7F0821EFCEEF2E3 FOREIGN KEY (counter_id) REFERENCES counter_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE counter_update_log_entity DROP CONSTRAINT FK_E7F0821EFCEEF2E3');
        $this->addSql('DROP SEQUENCE counter_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE counter_update_log_entity_id_seq CASCADE');
        $this->addSql('DROP TABLE counter_entity');
        $this->addSql('DROP TABLE counter_update_log_entity');
    }
}
