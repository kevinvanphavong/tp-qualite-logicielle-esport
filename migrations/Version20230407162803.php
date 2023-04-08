<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407162803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_32993751296CD8AE ON score (team_id)');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F12EB0A51');
        $this->addSql('DROP INDEX UNIQ_C4E0A61F12EB0A51 ON team');
        $this->addSql('ALTER TABLE team DROP score_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team ADD score_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F12EB0A51 FOREIGN KEY (score_id) REFERENCES score (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C4E0A61F12EB0A51 ON team (score_id)');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751296CD8AE');
        $this->addSql('DROP INDEX IDX_32993751296CD8AE ON score');
        $this->addSql('ALTER TABLE score DROP team_id');
    }
}
