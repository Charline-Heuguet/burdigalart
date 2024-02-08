<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208115351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE style ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE style ADD CONSTRAINT FK_33BDB86A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_33BDB86A12469DE2 ON style (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE style DROP FOREIGN KEY FK_33BDB86A12469DE2');
        $this->addSql('DROP INDEX IDX_33BDB86A12469DE2 ON style');
        $this->addSql('ALTER TABLE style DROP category_id');
    }
}
