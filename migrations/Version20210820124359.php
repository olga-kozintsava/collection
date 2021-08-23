<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820124359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_custom_field (id INT AUTO_INCREMENT NOT NULL, field VARCHAR(191) DEFAULT NULL, value VARCHAR(191) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_custom_field_item (item_custom_field_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_BE181FF81B243B76 (item_custom_field_id), INDEX IDX_BE181FF8126F525E (item_id), PRIMARY KEY(item_custom_field_id, item_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_custom_field_item ADD CONSTRAINT FK_BE181FF81B243B76 FOREIGN KEY (item_custom_field_id) REFERENCES item_custom_field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_custom_field_item ADD CONSTRAINT FK_BE181FF8126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_custom_field_item DROP FOREIGN KEY FK_BE181FF81B243B76');
        $this->addSql('DROP TABLE item_custom_field');
        $this->addSql('DROP TABLE item_custom_field_item');
    }
}
