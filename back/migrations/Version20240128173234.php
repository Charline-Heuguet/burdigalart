<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240128173234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1599687A76ED395 ON artist (user_id)');
        $this->addSql('ALTER TABLE event ADD scene_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7166053B4 ON event (scene_id)');
        $this->addSql('ALTER TABLE scene ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE scene ADD CONSTRAINT FK_D979EFDAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D979EFDAA76ED395 ON scene (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scene DROP FOREIGN KEY FK_D979EFDAA76ED395');
        $this->addSql('DROP INDEX IDX_D979EFDAA76ED395 ON scene');
        $this->addSql('ALTER TABLE scene DROP user_id');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687A76ED395');
        $this->addSql('DROP INDEX IDX_1599687A76ED395 ON artist');
        $this->addSql('ALTER TABLE artist DROP user_id');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7166053B4');
        $this->addSql('DROP INDEX IDX_3BAE0AA7166053B4 ON event');
        $this->addSql('ALTER TABLE event DROP scene_id');
    }
}
