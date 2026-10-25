<?php
declare(strict_types=1);

namespace AfroVerified\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261025120000 extends AbstractMigration
{
    public function getDescription(): string { return 'Add sponsors and per-event sponsorship'; }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE sponsors (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, logo VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, tagline VARCHAR(190) DEFAULT NULL, status VARCHAR(30) NOT NULL DEFAULT 'active', sort_order INT NOT NULL DEFAULT 0, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_SPONSOR_STATUS_ORDER (status, sort_order), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql('ALTER TABLE events ADD sponsor_id INT DEFAULT NULL AFTER organizer_id, ADD INDEX IDX_EVENT_SPONSOR (sponsor_id), ADD CONSTRAINT FK_EVENT_SPONSOR FOREIGN KEY (sponsor_id) REFERENCES sponsors (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_EVENT_SPONSOR, DROP INDEX IDX_EVENT_SPONSOR, DROP COLUMN sponsor_id');
        $this->addSql('DROP TABLE IF EXISTS sponsors');
    }
}
