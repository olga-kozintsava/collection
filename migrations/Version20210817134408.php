<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817134408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(191) NOT NULL, еtag LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', date DATETIME NOT NULL, integer1 INT DEFAULT NULL, integer2 INT DEFAULT NULL, integer3 INT DEFAULT NULL, string1 VARCHAR(191) DEFAULT NULL, string2 VARCHAR(191) DEFAULT NULL, string3 VARCHAR(191) DEFAULT NULL, text1 LONGTEXT DEFAULT NULL, text2 LONGTEXT DEFAULT NULL, text3 LONGTEXT DEFAULT NULL, INDEX IDX_1F1B251E12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE item');
    }
}
