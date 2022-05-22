<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220522164726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create list, list category and list group tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE list_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_list (id INT AUTO_INCREMENT NOT NULL, list_group_id INT DEFAULT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C920DAB98039EA27 (list_group_id), INDEX IDX_C920DAB912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_list ADD CONSTRAINT FK_C920DAB98039EA27 FOREIGN KEY (list_group_id) REFERENCES list_group (id)');
        $this->addSql('ALTER TABLE product_list ADD CONSTRAINT FK_C920DAB912469DE2 FOREIGN KEY (category_id) REFERENCES list_category (id)');
        $this->addSql('ALTER TABLE product_package ADD product_list_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_package ADD CONSTRAINT FK_FB17C25EC770D3B FOREIGN KEY (product_list_id) REFERENCES product_list (id)');
        $this->addSql('CREATE INDEX IDX_FB17C25EC770D3B ON product_package (product_list_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_list DROP FOREIGN KEY FK_C920DAB912469DE2');
        $this->addSql('ALTER TABLE product_list DROP FOREIGN KEY FK_C920DAB98039EA27');
        $this->addSql('ALTER TABLE product_package DROP FOREIGN KEY FK_FB17C25EC770D3B');
        $this->addSql('DROP TABLE list_category');
        $this->addSql('DROP TABLE list_group');
        $this->addSql('DROP TABLE product_list');
        $this->addSql('DROP INDEX IDX_FB17C25EC770D3B ON product_package');
        $this->addSql('ALTER TABLE product_package DROP product_list_id');
    }
}
