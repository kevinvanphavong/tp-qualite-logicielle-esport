<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407061744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team ADD score_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F12EB0A51 FOREIGN KEY (score_id) REFERENCES score (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4E0A61F12EB0A51 ON team (score_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F12EB0A51');
        $this->addSql('DROP INDEX UNIQ_C4E0A61F12EB0A51 ON team');
        $this->addSql('ALTER TABLE team DROP score_id');
    }
}
