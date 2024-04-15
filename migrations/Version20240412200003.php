<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412200003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE extension (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, langue_id INTEGER NOT NULL, nom VARCHAR(100) NOT NULL, apk_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_9FB73D772AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9FB73D772AADBACD ON extension (langue_id)');
        $this->addSql('CREATE TABLE extension_type_extension (extension_id INTEGER NOT NULL, type_extension_id INTEGER NOT NULL, PRIMARY KEY(extension_id, type_extension_id), CONSTRAINT FK_B25213BC812D5EB FOREIGN KEY (extension_id) REFERENCES extension (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B25213BC8F516FEE FOREIGN KEY (type_extension_id) REFERENCES type_extension (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B25213BC812D5EB ON extension_type_extension (extension_id)');
        $this->addSql('CREATE INDEX IDX_B25213BC8F516FEE ON extension_type_extension (type_extension_id)');
        $this->addSql('CREATE TABLE langue (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nomlangue VARCHAR(20) NOT NULL, sigle VARCHAR(10) NOT NULL)');
        $this->addSql('CREATE TABLE type_extension (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE extension');
        $this->addSql('DROP TABLE extension_type_extension');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE type_extension');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
