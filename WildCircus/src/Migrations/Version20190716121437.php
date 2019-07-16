<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716121437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_performance (artist_id INT NOT NULL, performance_id INT NOT NULL, INDEX IDX_ABED20C6B7970CF8 (artist_id), INDEX IDX_ABED20C6B91ADEEE (performance_id), PRIMARY KEY(artist_id, performance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, spectacle_id INT DEFAULT NULL, nbperson INT NOT NULL, mail VARCHAR(255) NOT NULL, INDEX IDX_42C84955C682915D (spectacle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spectacle (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spectacle_performance (spectacle_id INT NOT NULL, performance_id INT NOT NULL, INDEX IDX_44C32B48C682915D (spectacle_id), INDEX IDX_44C32B48B91ADEEE (performance_id), PRIMARY KEY(spectacle_id, performance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_performance ADD CONSTRAINT FK_ABED20C6B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_performance ADD CONSTRAINT FK_ABED20C6B91ADEEE FOREIGN KEY (performance_id) REFERENCES performance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955C682915D FOREIGN KEY (spectacle_id) REFERENCES spectacle (id)');
        $this->addSql('ALTER TABLE spectacle_performance ADD CONSTRAINT FK_44C32B48C682915D FOREIGN KEY (spectacle_id) REFERENCES spectacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spectacle_performance ADD CONSTRAINT FK_44C32B48B91ADEEE FOREIGN KEY (performance_id) REFERENCES performance (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist_performance DROP FOREIGN KEY FK_ABED20C6B7970CF8');
        $this->addSql('ALTER TABLE artist_performance DROP FOREIGN KEY FK_ABED20C6B91ADEEE');
        $this->addSql('ALTER TABLE spectacle_performance DROP FOREIGN KEY FK_44C32B48B91ADEEE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955C682915D');
        $this->addSql('ALTER TABLE spectacle_performance DROP FOREIGN KEY FK_44C32B48C682915D');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_performance');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE spectacle');
        $this->addSql('DROP TABLE spectacle_performance');
    }
}
