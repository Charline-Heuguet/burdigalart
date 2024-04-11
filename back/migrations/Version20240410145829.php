<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240410145829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, date_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', poster VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_artist (event_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_33C0E1D571F7E88B (event_id), INDEX IDX_33C0E1D5B7970CF8 (artist_id), PRIMARY KEY(event_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_artist ADD CONSTRAINT FK_33C0E1D571F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_artist ADD CONSTRAINT FK_33C0E1D5B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_scene DROP FOREIGN KEY FK_B975DF89166053B4');
        $this->addSql('ALTER TABLE artist_scene DROP FOREIGN KEY FK_B975DF89B7970CF8');
        $this->addSql('DROP TABLE artist_scene');
        $this->addSql('ALTER TABLE scene DROP event_title, DROP event_description, DROP event_date_time, DROP event_poster, DROP event_price');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist_scene (artist_id INT NOT NULL, scene_id INT NOT NULL, INDEX IDX_B975DF89B7970CF8 (artist_id), INDEX IDX_B975DF89166053B4 (scene_id), PRIMARY KEY(artist_id, scene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artist_scene ADD CONSTRAINT FK_B975DF89166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_scene ADD CONSTRAINT FK_B975DF89B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_artist DROP FOREIGN KEY FK_33C0E1D571F7E88B');
        $this->addSql('ALTER TABLE event_artist DROP FOREIGN KEY FK_33C0E1D5B7970CF8');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_artist');
        $this->addSql('ALTER TABLE scene ADD event_title VARCHAR(255) NOT NULL, ADD event_description LONGTEXT NOT NULL, ADD event_date_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD event_poster VARCHAR(255) NOT NULL, ADD event_price DOUBLE PRECISION NOT NULL');
    }
}
