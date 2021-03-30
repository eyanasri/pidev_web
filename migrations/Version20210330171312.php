<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330171312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscri (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscri_cours (inscri_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_8277F04ADC74319E (inscri_id), INDEX IDX_8277F04A7ECF78B0 (cours_id), PRIMARY KEY(inscri_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscri_users (inscri_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_6B3ED93FDC74319E (inscri_id), INDEX IDX_6B3ED93F67B3B43D (users_id), PRIMARY KEY(inscri_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscri_cours ADD CONSTRAINT FK_8277F04ADC74319E FOREIGN KEY (inscri_id) REFERENCES inscri (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscri_cours ADD CONSTRAINT FK_8277F04A7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscri_users ADD CONSTRAINT FK_6B3ED93FDC74319E FOREIGN KEY (inscri_id) REFERENCES inscri (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscri_users ADD CONSTRAINT FK_6B3ED93F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscri_cours DROP FOREIGN KEY FK_8277F04ADC74319E');
        $this->addSql('ALTER TABLE inscri_users DROP FOREIGN KEY FK_6B3ED93FDC74319E');
        $this->addSql('DROP TABLE inscri');
        $this->addSql('DROP TABLE inscri_cours');
        $this->addSql('DROP TABLE inscri_users');
    }
}
