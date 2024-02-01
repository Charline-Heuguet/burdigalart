<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240130173238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, user_id INT NOT NULL, style_id INT DEFAULT NULL, official_photo VARCHAR(255) NOT NULL, artist_name VARCHAR(255) NOT NULL, link_excerpt VARCHAR(255) NOT NULL, facebook VARCHAR(255) NOT NULL, instagram VARCHAR(255) NOT NULL, show_photo VARCHAR(255) NOT NULL, show_title VARCHAR(255) NOT NULL, show_description LONGTEXT NOT NULL, INDEX IDX_159968712469DE2 (category_id), INDEX IDX_1599687A76ED395 (user_id), INDEX IDX_1599687BACD6074 (style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_event (artist_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_5BA23AF4B7970CF8 (artist_id), INDEX IDX_5BA23AF471F7E88B (event_id), PRIMARY KEY(artist_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_artist (artist_source INT NOT NULL, artist_target INT NOT NULL, INDEX IDX_F35B9AF9AD88730D (artist_source), INDEX IDX_F35B9AF9B46D2382 (artist_target), PRIMARY KEY(artist_source, artist_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, scene_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_time DATETIME NOT NULL, event_photo VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_3BAE0AA7166053B4 (scene_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scene (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, siret INT NOT NULL, banner VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, zip_code INT NOT NULL, town VARCHAR(255) NOT NULL, phone INT NOT NULL, capacity INT NOT NULL, instagram VARCHAR(255) NOT NULL, facebook VARCHAR(255) NOT NULL, INDEX IDX_D979EFDAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, style_name VARCHAR(255) NOT NULL, INDEX IDX_33BDB86A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_event (user_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_D96CF1FFA76ED395 (user_id), INDEX IDX_D96CF1FF71F7E88B (event_id), PRIMARY KEY(user_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_159968712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687BACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE artist_event ADD CONSTRAINT FK_5BA23AF4B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_event ADD CONSTRAINT FK_5BA23AF471F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_artist ADD CONSTRAINT FK_F35B9AF9AD88730D FOREIGN KEY (artist_source) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_artist ADD CONSTRAINT FK_F35B9AF9B46D2382 FOREIGN KEY (artist_target) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE scene ADD CONSTRAINT FK_D979EFDAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE style ADD CONSTRAINT FK_33BDB86A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FF71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_159968712469DE2');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687A76ED395');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687BACD6074');
        $this->addSql('ALTER TABLE artist_event DROP FOREIGN KEY FK_5BA23AF4B7970CF8');
        $this->addSql('ALTER TABLE artist_event DROP FOREIGN KEY FK_5BA23AF471F7E88B');
        $this->addSql('ALTER TABLE artist_artist DROP FOREIGN KEY FK_F35B9AF9AD88730D');
        $this->addSql('ALTER TABLE artist_artist DROP FOREIGN KEY FK_F35B9AF9B46D2382');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7166053B4');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('ALTER TABLE scene DROP FOREIGN KEY FK_D979EFDAA76ED395');
        $this->addSql('ALTER TABLE style DROP FOREIGN KEY FK_33BDB86A12469DE2');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FFA76ED395');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FF71F7E88B');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_event');
        $this->addSql('DROP TABLE artist_artist');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE scene');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_event');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
