<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230731091517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache ADD project_name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075E70990B3 FOREIGN KEY (project_name_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_93872075E70990B3 ON tache (project_name_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075E70990B3');
        $this->addSql('DROP INDEX IDX_93872075E70990B3 ON tache');
        $this->addSql('ALTER TABLE tache DROP project_name_id');
    }
}
