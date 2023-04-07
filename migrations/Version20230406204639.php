<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230406204639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ematch_team (ematch_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_C01F48DBF61A3FA (ematch_id), INDEX IDX_C01F48D296CD8AE (team_id), PRIMARY KEY(ematch_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ematch_team ADD CONSTRAINT FK_C01F48DBF61A3FA FOREIGN KEY (ematch_id) REFERENCES ematch (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ematch_team ADD CONSTRAINT FK_C01F48D296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ematch DROP FOREIGN KEY FK_55820D52205B5690');
        $this->addSql('ALTER TABLE ematch DROP FOREIGN KEY FK_55820D52A24F7E79');
        $this->addSql('DROP INDEX IDX_55820D52205B5690 ON ematch');
        $this->addSql('DROP INDEX IDX_55820D52A24F7E79 ON ematch');
        $this->addSql('ALTER TABLE ematch DROP hometeam_id, DROP awayteam_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ematch_team DROP FOREIGN KEY FK_C01F48DBF61A3FA');
        $this->addSql('ALTER TABLE ematch_team DROP FOREIGN KEY FK_C01F48D296CD8AE');
        $this->addSql('DROP TABLE ematch_team');
        $this->addSql('ALTER TABLE ematch ADD hometeam_id INT DEFAULT NULL, ADD awayteam_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ematch ADD CONSTRAINT FK_55820D52205B5690 FOREIGN KEY (hometeam_id) REFERENCES team (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ematch ADD CONSTRAINT FK_55820D52A24F7E79 FOREIGN KEY (awayteam_id) REFERENCES team (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_55820D52205B5690 ON ematch (hometeam_id)');
        $this->addSql('CREATE INDEX IDX_55820D52A24F7E79 ON ematch (awayteam_id)');
    }
}
