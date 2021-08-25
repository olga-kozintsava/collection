<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824164908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_custom_field DROP FOREIGN KEY FK_57A240F0126F525E');
        $this->addSql('ALTER TABLE item_custom_field CHANGE item_id item_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_custom_field ADD CONSTRAINT FK_57A240F0126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_custom_field DROP FOREIGN KEY FK_57A240F0126F525E');
        $this->addSql('ALTER TABLE item_custom_field CHANGE item_id item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item_custom_field ADD CONSTRAINT FK_57A240F0126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }
}
