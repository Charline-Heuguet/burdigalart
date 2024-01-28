<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240128191124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Recommendation RENAME INDEX idx_8e565c0aad88730d TO IDX_433224D2AD88730D');
        $this->addSql('ALTER TABLE Recommendation RENAME INDEX idx_8e565c0ab46d2382 TO IDX_433224D2B46D2382');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recommendation RENAME INDEX idx_433224d2b46d2382 TO IDX_8E565C0AB46D2382');
        $this->addSql('ALTER TABLE recommendation RENAME INDEX idx_433224d2ad88730d TO IDX_8E565C0AAD88730D');
    }
}
