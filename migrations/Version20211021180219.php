<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211021180219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command_line_orders (command_line_id INT NOT NULL, orders_id INT NOT NULL, INDEX IDX_94F6A9A8A21126A1 (command_line_id), INDEX IDX_94F6A9A8CFFE9AD6 (orders_id), PRIMARY KEY(command_line_id, orders_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command_line_orders ADD CONSTRAINT FK_94F6A9A8A21126A1 FOREIGN KEY (command_line_id) REFERENCES command_line (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_line_orders ADD CONSTRAINT FK_94F6A9A8CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE command_line_orders');
    }
}
