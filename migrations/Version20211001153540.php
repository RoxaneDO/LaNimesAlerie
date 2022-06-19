<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211001153540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7B1BE1FB52');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP INDEX IDX_70BE1A7B1BE1FB52 ON command_line');
        $this->addSql('ALTER TABLE command_line DROP basket_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_2246507BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE command_line ADD basket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B1BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('CREATE INDEX IDX_70BE1A7B1BE1FB52 ON command_line (basket_id)');
    }
}
