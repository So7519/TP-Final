<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251218135306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fix email column NOT NULL constraint and create reset_password_request table';
    }

    public function up(Schema $schema): void
    {
        // First, make email nullable temporarily to update existing rows
        $this->addSql('ALTER TABLE `user` CHANGE email email VARCHAR(255)');
        
        // Set a default email for users that have NULL email
        $this->addSql('UPDATE `user` SET email = CONCAT(\'user_\', id, \'@example.com\') WHERE email IS NULL');
        
        // Now make email NOT NULL again
        $this->addSql('ALTER TABLE `user` CHANGE email email VARCHAR(255) NOT NULL');
        
        // Create the reset_password_request table
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL, expires_at DATETIME NOT NULL, user_id INT NOT NULL, INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE `user` CHANGE email email VARCHAR(255)');
    }
}
