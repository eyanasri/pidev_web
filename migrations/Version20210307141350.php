<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307141350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C5DE3FDC4');
        $this->addSql('DROP INDEX IDX_9474526C5DE3FDC4 ON comment');
        $this->addSql('ALTER TABLE comment DROP id_comment_id');
        $this->addSql('ALTER TABLE post ADD id_note_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF870A125 FOREIGN KEY (id_note_id) REFERENCES comment (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF870A125 ON post (id_note_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD id_comment_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C5DE3FDC4 FOREIGN KEY (id_comment_id) REFERENCES post (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9474526C5DE3FDC4 ON comment (id_comment_id)');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DF870A125');
        $this->addSql('DROP INDEX IDX_5A8A6C8DF870A125 ON post');
        $this->addSql('ALTER TABLE post DROP id_note_id');
    }
}
