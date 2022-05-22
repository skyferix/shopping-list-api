<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220522160018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added product, it\'s category, count, package tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_count (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, kg DOUBLE PRECISION DEFAULT NULL, unit INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_package (id INT AUTO_INCREMENT NOT NULL, count_id INT DEFAULT NULL, product_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_FB17C2546083A8A (count_id), INDEX IDX_FB17C254584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES product_category (id)');
        $this->addSql('ALTER TABLE product_package ADD CONSTRAINT FK_FB17C2546083A8A FOREIGN KEY (count_id) REFERENCES product_count (id)');
        $this->addSql('ALTER TABLE product_package ADD CONSTRAINT FK_FB17C254584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE product_package DROP FOREIGN KEY FK_FB17C254584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product_package DROP FOREIGN KEY FK_FB17C2546083A8A');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_count');
        $this->addSql('DROP TABLE product_package');
    }
}
