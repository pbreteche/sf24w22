<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528083836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add TShirt entity to work with forms.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE tshirt (id INT AUTO_INCREMENT NOT NULL, reference_number VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', size VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE tshirt');
    }
}
