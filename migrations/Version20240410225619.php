<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240410225619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE extension (id INT AUTO_INCREMENT NOT NULL, langue_id INT NOT NULL, nom VARCHAR(100) NOT NULL, apk_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9FB73D772AADBACD (langue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE extension_type_extension (extension_id INT NOT NULL, type_extension_id INT NOT NULL, INDEX IDX_B25213BC812D5EB (extension_id), INDEX IDX_B25213BC8F516FEE (type_extension_id), PRIMARY KEY(extension_id, type_extension_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, nomlangue VARCHAR(20) NOT NULL, sigle VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_extension (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE extension ADD CONSTRAINT FK_9FB73D772AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE extension_type_extension ADD CONSTRAINT FK_B25213BC812D5EB FOREIGN KEY (extension_id) REFERENCES extension (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE extension_type_extension ADD CONSTRAINT FK_B25213BC8F516FEE FOREIGN KEY (type_extension_id) REFERENCES type_extension (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE extension DROP FOREIGN KEY FK_9FB73D772AADBACD');
        $this->addSql('ALTER TABLE extension_type_extension DROP FOREIGN KEY FK_B25213BC812D5EB');
        $this->addSql('ALTER TABLE extension_type_extension DROP FOREIGN KEY FK_B25213BC8F516FEE');
        $this->addSql('DROP TABLE extension');
        $this->addSql('DROP TABLE extension_type_extension');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE type_extension');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
