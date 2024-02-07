<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207233253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scene ADD event_title VARCHAR(255) NOT NULL, ADD event_description LONGTEXT NOT NULL, ADD event_datetime DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD event_poster VARCHAR(255) NOT NULL, ADD event_price DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scene DROP event_title, DROP event_description, DROP event_datetime, DROP event_poster, DROP event_price');
    }
}
