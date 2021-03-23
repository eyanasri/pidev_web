<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311094557 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE attestation');
        $this->addSql('ALTER TABLE cat_event DROP FOREIGN KEY FK_87D5BA4A212C041E');
        $this->addSql('ALTER TABLE cat_event ADD CONSTRAINT FK_87D5BA4A212C041E FOREIGN KEY (id_event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event ADD capacité INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attestation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cat_event DROP FOREIGN KEY FK_87D5BA4A212C041E');
        $this->addSql('ALTER TABLE cat_event ADD CONSTRAINT FK_87D5BA4A212C041E FOREIGN KEY (id_event_id) REFERENCES event (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event DROP capacité');
    }
}
