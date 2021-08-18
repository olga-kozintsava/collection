<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818105550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item ADD date1 DATE DEFAULT NULL, ADD date2 DATE DEFAULT NULL, ADD date3 DATE DEFAULT NULL, ADD bool1 TINYINT(1) DEFAULT NULL, ADD bool2 TINYINT(1) DEFAULT NULL, ADD bool3 TINYINT(1) DEFAULT NULL, CHANGE date date_create DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item DROP date1, DROP date2, DROP date3, DROP bool1, DROP bool2, DROP bool3, CHANGE date_create date DATETIME NOT NULL');
    }
}
