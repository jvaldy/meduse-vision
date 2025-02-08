<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130152457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cycle ADD min_cycle_length INT NOT NULL, ADD max_cycle_length INT NOT NULL, DROP cycle_length, CHANGE start_date start_date DATE NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL, CHANGE phone phone VARCHAR(20) NOT NULL, CHANGE birthday birthday DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cycle ADD cycle_length INT DEFAULT NULL, DROP min_cycle_length, DROP max_cycle_length, CHANGE start_date start_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(20) DEFAULT NULL, CHANGE birthday birthday DATE DEFAULT NULL');
    }
}
