<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210824114944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE item_custom_field_item');
        $this->addSql('ALTER TABLE item DROP integer1, DROP integer2, DROP integer3, DROP string1, DROP string2, DROP string3, DROP text1, DROP text2, DROP text3, DROP date1, DROP date2, DROP date3, DROP bool1, DROP bool2, DROP bool3');
        $this->addSql('ALTER TABLE item_custom_field ADD item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item_custom_field ADD CONSTRAINT FK_57A240F0126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('CREATE INDEX IDX_57A240F0126F525E ON item_custom_field (item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_custom_field_item (item_custom_field_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_BE181FF8126F525E (item_id), INDEX IDX_BE181FF81B243B76 (item_custom_field_id), PRIMARY KEY(item_custom_field_id, item_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE item_custom_field_item ADD CONSTRAINT FK_BE181FF8126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_custom_field_item ADD CONSTRAINT FK_BE181FF81B243B76 FOREIGN KEY (item_custom_field_id) REFERENCES item_custom_field (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item ADD integer1 INT DEFAULT NULL, ADD integer2 INT DEFAULT NULL, ADD integer3 INT DEFAULT NULL, ADD string1 VARCHAR(191) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ADD string2 VARCHAR(191) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ADD string3 VARCHAR(191) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ADD text1 LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ADD text2 LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ADD text3 LONGTEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, ADD date1 DATE DEFAULT NULL, ADD date2 DATE DEFAULT NULL, ADD date3 DATE DEFAULT NULL, ADD bool1 TINYINT(1) DEFAULT NULL, ADD bool2 TINYINT(1) DEFAULT NULL, ADD bool3 TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE item_custom_field DROP FOREIGN KEY FK_57A240F0126F525E');
        $this->addSql('DROP INDEX IDX_57A240F0126F525E ON item_custom_field');
        $this->addSql('ALTER TABLE item_custom_field DROP item_id');
    }
}
