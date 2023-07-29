<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230729175210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD id INT AUTO_INCREMENT NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD status VARCHAR(255) NOT NULL, ADD priorite VARCHAR(255) NOT NULL, DROP description, DROP progrès, DROP chef_du_projet, DROP equipe, CHANGE date_limite date DATE NOT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON project');
        $this->addSql('ALTER TABLE project ADD description VARCHAR(255) NOT NULL, ADD progrès VARCHAR(255) NOT NULL, ADD chef_du_projet VARCHAR(255) NOT NULL, ADD equipe VARCHAR(255) NOT NULL, DROP id, DROP nom, DROP status, DROP priorite, CHANGE date date_limite DATE NOT NULL');
    }
}
