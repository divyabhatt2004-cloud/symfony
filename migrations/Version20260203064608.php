<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260203064608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, record_state INT DEFAULT 0, category_name VARCHAR(255) DEFAULT NULL, category_type VARCHAR(255) DEFAULT NULL, category_description VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, record_state INT DEFAULT 0, product_name VARCHAR(255) DEFAULT NULL, product_image VARCHAR(255) DEFAULT NULL, product_description VARCHAR(255) DEFAULT NULL, quantity INT DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, gst INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE todo_lists (id INT AUTO_INCREMENT NOT NULL, record_state INT DEFAULT 0, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_contact (id INT AUTO_INCREMENT NOT NULL, record_state INT DEFAULT 0, name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, subject VARCHAR(255) DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE todo_lists');
        $this->addSql('DROP TABLE user_contact');
    }
}
