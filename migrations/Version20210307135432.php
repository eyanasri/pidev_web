<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307135432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meet (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meet_users (meet_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_7E32916C3BBBF66 (meet_id), INDEX IDX_7E32916C67B3B43D (users_id), PRIMARY KEY(meet_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, id_meet_id INT NOT NULL, message VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_DB021E96DD261616 (id_meet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meet_users ADD CONSTRAINT FK_7E32916C3BBBF66 FOREIGN KEY (meet_id) REFERENCES meet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meet_users ADD CONSTRAINT FK_7E32916C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96DD261616 FOREIGN KEY (id_meet_id) REFERENCES meet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meet_users DROP FOREIGN KEY FK_7E32916C3BBBF66');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96DD261616');
        $this->addSql('DROP TABLE meet');
        $this->addSql('DROP TABLE meet_users');
        $this->addSql('DROP TABLE messages');
    }
}
