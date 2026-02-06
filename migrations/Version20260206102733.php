<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260206102733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_product (id INT AUTO_INCREMENT NOT NULL, record_state INT DEFAULT 0, product_name VARCHAR(255) DEFAULT NULL, product_image VARCHAR(255) DEFAULT NULL, product_description VARCHAR(255) DEFAULT NULL, quantity INT DEFAULT NULL, price INT DEFAULT NULL, gst INT DEFAULT NULL, product_id VARCHAR(255) DEFAULT NULL, category_id INT DEFAULT NULL, INDEX IDX_2890CCAA12469DE2 (category_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE cart_product ADD CONSTRAINT FK_2890CCAA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE todo_lists');
        $this->addSql('ALTER TABLE category DROP category_type');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user_contact ADD reply VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE todo_lists (id INT AUTO_INCREMENT NOT NULL, record_state INT DEFAULT 0, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cart_product DROP FOREIGN KEY FK_2890CCAA12469DE2');
        $this->addSql('DROP TABLE cart_product');
        $this->addSql('ALTER TABLE category ADD category_type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE user_contact DROP reply');
    }
}
