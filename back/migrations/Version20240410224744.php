<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240410224744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_scene DROP FOREIGN KEY FK_3BBB1482166053B4');
        $this->addSql('ALTER TABLE user_scene DROP FOREIGN KEY FK_3BBB1482A76ED395');
        $this->addSql('DROP TABLE user_scene');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_scene (user_id INT NOT NULL, scene_id INT NOT NULL, INDEX IDX_3BBB1482A76ED395 (user_id), INDEX IDX_3BBB1482166053B4 (scene_id), PRIMARY KEY(user_id, scene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_scene ADD CONSTRAINT FK_3BBB1482166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_scene ADD CONSTRAINT FK_3BBB1482A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('DROP TABLE event_user');
    }
}
