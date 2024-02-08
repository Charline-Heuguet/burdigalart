<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208121745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist_artist (artist_source INT NOT NULL, artist_target INT NOT NULL, INDEX IDX_F35B9AF9AD88730D (artist_source), INDEX IDX_F35B9AF9B46D2382 (artist_target), PRIMARY KEY(artist_source, artist_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_scene (artist_id INT NOT NULL, scene_id INT NOT NULL, INDEX IDX_B975DF89B7970CF8 (artist_id), INDEX IDX_B975DF89166053B4 (scene_id), PRIMARY KEY(artist_id, scene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_scene (user_id INT NOT NULL, scene_id INT NOT NULL, INDEX IDX_3BBB1482A76ED395 (user_id), INDEX IDX_3BBB1482166053B4 (scene_id), PRIMARY KEY(user_id, scene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_artist ADD CONSTRAINT FK_F35B9AF9AD88730D FOREIGN KEY (artist_source) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_artist ADD CONSTRAINT FK_F35B9AF9B46D2382 FOREIGN KEY (artist_target) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_scene ADD CONSTRAINT FK_B975DF89B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_scene ADD CONSTRAINT FK_B975DF89166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_scene ADD CONSTRAINT FK_3BBB1482A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_scene ADD CONSTRAINT FK_3BBB1482166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_artist DROP FOREIGN KEY FK_F35B9AF9AD88730D');
        $this->addSql('ALTER TABLE artist_artist DROP FOREIGN KEY FK_F35B9AF9B46D2382');
        $this->addSql('ALTER TABLE artist_scene DROP FOREIGN KEY FK_B975DF89B7970CF8');
        $this->addSql('ALTER TABLE artist_scene DROP FOREIGN KEY FK_B975DF89166053B4');
        $this->addSql('ALTER TABLE user_scene DROP FOREIGN KEY FK_3BBB1482A76ED395');
        $this->addSql('ALTER TABLE user_scene DROP FOREIGN KEY FK_3BBB1482166053B4');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('DROP TABLE artist_artist');
        $this->addSql('DROP TABLE artist_scene');
        $this->addSql('DROP TABLE user_scene');
        $this->addSql('DROP TABLE user_role');
    }
}
