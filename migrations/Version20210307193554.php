<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210307193554 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, nom_complet_cours VARCHAR(255) NOT NULL, nom_aberge_cours VARCHAR(255) NOT NULL, date_debut_cours DATE NOT NULL, date_fin_cours DATE NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meet (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meet_users (meet_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_7E32916C3BBBF66 (meet_id), INDEX IDX_7E32916C67B3B43D (users_id), PRIMARY KEY(meet_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, id_meet_id INT NOT NULL, message VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_DB021E96DD261616 (id_meet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, nom_categorie_id INT DEFAULT NULL, nom_entreprise VARCHAR(255) NOT NULL, salaire INT NOT NULL, description LONGTEXT NOT NULL, localisation VARCHAR(255) NOT NULL, nombre_heure INT NOT NULL, type_contrat VARCHAR(255) NOT NULL, niveau_etude VARCHAR(255) NOT NULL, experience INT DEFAULT NULL, langue VARCHAR(255) NOT NULL, date_expiration DATE NOT NULL, tel INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_AF86866F31338A73 (nom_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_users (offre_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_43A942724CC8505A (offre_id), INDEX IDX_43A9427267B3B43D (users_id), PRIMARY KEY(offre_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, id_note_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date DATE NOT NULL, cv VARCHAR(255) NOT NULL, INDEX IDX_5A8A6C8DF870A125 (id_note_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_users (post_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_839829064B89032C (post_id), INDEX IDX_8398290667B3B43D (users_id), PRIMARY KEY(post_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, question1 VARCHAR(255) NOT NULL, reponse1 VARCHAR(255) DEFAULT NULL, question2 VARCHAR(255) NOT NULL, reponse2 VARCHAR(255) NOT NULL, question3 VARCHAR(255) NOT NULL, reponse3 VARCHAR(255) DEFAULT NULL, question4 VARCHAR(255) NOT NULL, reponse4 VARCHAR(255) DEFAULT NULL, question5 VARCHAR(255) NOT NULL, reponse5 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_users (test_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_1F5D03E21E5D0459 (test_id), INDEX IDX_1F5D03E267B3B43D (users_id), PRIMARY KEY(test_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_event (users_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_DCD9AEEE67B3B43D (users_id), INDEX IDX_DCD9AEEE71F7E88B (event_id), PRIMARY KEY(users_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meet_users ADD CONSTRAINT FK_7E32916C3BBBF66 FOREIGN KEY (meet_id) REFERENCES meet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meet_users ADD CONSTRAINT FK_7E32916C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96DD261616 FOREIGN KEY (id_meet_id) REFERENCES meet (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F31338A73 FOREIGN KEY (nom_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE offre_users ADD CONSTRAINT FK_43A942724CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_users ADD CONSTRAINT FK_43A9427267B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF870A125 FOREIGN KEY (id_note_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE post_users ADD CONSTRAINT FK_839829064B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_users ADD CONSTRAINT FK_8398290667B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE test_users ADD CONSTRAINT FK_1F5D03E21E5D0459 FOREIGN KEY (test_id) REFERENCES test (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE test_users ADD CONSTRAINT FK_1F5D03E267B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_event ADD CONSTRAINT FK_DCD9AEEE67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_event ADD CONSTRAINT FK_DCD9AEEE71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F31338A73');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DF870A125');
        $this->addSql('ALTER TABLE meet_users DROP FOREIGN KEY FK_7E32916C3BBBF66');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96DD261616');
        $this->addSql('ALTER TABLE offre_users DROP FOREIGN KEY FK_43A942724CC8505A');
        $this->addSql('ALTER TABLE post_users DROP FOREIGN KEY FK_839829064B89032C');
        $this->addSql('ALTER TABLE test_users DROP FOREIGN KEY FK_1F5D03E21E5D0459');
        $this->addSql('ALTER TABLE meet_users DROP FOREIGN KEY FK_7E32916C67B3B43D');
        $this->addSql('ALTER TABLE offre_users DROP FOREIGN KEY FK_43A9427267B3B43D');
        $this->addSql('ALTER TABLE post_users DROP FOREIGN KEY FK_8398290667B3B43D');
        $this->addSql('ALTER TABLE test_users DROP FOREIGN KEY FK_1F5D03E267B3B43D');
        $this->addSql('ALTER TABLE users_event DROP FOREIGN KEY FK_DCD9AEEE67B3B43D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE meet');
        $this->addSql('DROP TABLE meet_users');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_users');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_users');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE test_users');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_event');
    }
}
