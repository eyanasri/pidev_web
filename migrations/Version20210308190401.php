<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210308190401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D62E149425');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D679F37AE5');
        $this->addSql('DROP INDEX UNIQ_5E90F6D62E149425 ON inscription');
        $this->addSql('DROP INDEX UNIQ_5E90F6D679F37AE5 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP id_user_id, DROP id_cours_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD id_user_id INT NOT NULL, ADD id_cours_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D62E149425 FOREIGN KEY (id_cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D679F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D62E149425 ON inscription (id_cours_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5E90F6D679F37AE5 ON inscription (id_user_id)');
    }
}
