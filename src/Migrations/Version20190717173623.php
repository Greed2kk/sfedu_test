<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190717173623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE employee ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE employee ADD fio VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE employee ADD bdate DATE NOT NULL');
        $this->addSql('ALTER TABLE employee ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE employee ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE employee ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE employee DROP id');
        $this->addSql('ALTER TABLE employee DROP fio');
        $this->addSql('ALTER TABLE employee DROP bdate');
        $this->addSql('ALTER TABLE employee DROP image');
        $this->addSql('ALTER TABLE employee DROP updated_at');
    }
}
