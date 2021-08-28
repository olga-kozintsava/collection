<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210828114605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_custom_field (category_id INT NOT NULL, custom_field_id INT NOT NULL, INDEX IDX_422F9EA312469DE2 (category_id), INDEX IDX_422F9EA3A1E5E0D4 (custom_field_id), PRIMARY KEY(category_id, custom_field_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_custom_field ADD CONSTRAINT FK_422F9EA312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_custom_field ADD CONSTRAINT FK_422F9EA3A1E5E0D4 FOREIGN KEY (custom_field_id) REFERENCES custom_field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE custom_field DROP category');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category_custom_field');
        $this->addSql('ALTER TABLE custom_field ADD category INT NOT NULL');
    }
}
