<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208120138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist ADD category_id INT NOT NULL, ADD style_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_159968712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687BACD6074 FOREIGN KEY (style_id) REFERENCES style (id)');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_159968712469DE2 ON artist (category_id)');
        $this->addSql('CREATE INDEX IDX_1599687BACD6074 ON artist (style_id)');
        $this->addSql('CREATE INDEX IDX_1599687A76ED395 ON artist (user_id)');
        $this->addSql('ALTER TABLE scene ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE scene ADD CONSTRAINT FK_D979EFDAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D979EFDAA76ED395 ON scene (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_159968712469DE2');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687BACD6074');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687A76ED395');
        $this->addSql('DROP INDEX IDX_159968712469DE2 ON artist');
        $this->addSql('DROP INDEX IDX_1599687BACD6074 ON artist');
        $this->addSql('DROP INDEX IDX_1599687A76ED395 ON artist');
        $this->addSql('ALTER TABLE artist DROP category_id, DROP style_id, DROP user_id');
        $this->addSql('ALTER TABLE scene DROP FOREIGN KEY FK_D979EFDAA76ED395');
        $this->addSql('DROP INDEX IDX_D979EFDAA76ED395 ON scene');
        $this->addSql('ALTER TABLE scene DROP user_id');
    }
}
