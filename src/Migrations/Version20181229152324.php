<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181229152324 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lab_day (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, github VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lab_day_team (id INT AUTO_INCREMENT NOT NULL, lab_day_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_B58460F49C1AC772 (lab_day_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personal_skill (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, skill_id_id INT NOT NULL, INDEX IDX_664A2619D86650F (user_id_id), INDEX IDX_664A2615A6C0D6B (skill_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school_class (id INT AUTO_INCREMENT NOT NULL, class VARCHAR(255) NOT NULL, group_name VARCHAR(255) NOT NULL, site VARCHAR(255) NOT NULL, year VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_certification_vote (id INT AUTO_INCREMENT NOT NULL, certified_personal_skill_id INT NOT NULL, UNIQUE INDEX UNIQ_8DB2F7F9D9D30CA (certified_personal_skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_certification_vote_user (skill_certification_vote_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1A603EFD3AF1D964 (skill_certification_vote_id), INDEX IDX_1A603EFDA76ED395 (user_id), PRIMARY KEY(skill_certification_vote_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_network (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, profile_url VARCHAR(255) NOT NULL, INDEX IDX_EFFF5221A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, discipline VARCHAR(255) DEFAULT NULL, affinity DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_user (team_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5C722232296CD8AE (team_id), INDEX IDX_5C722232A76ED395 (user_id), PRIMARY KEY(team_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lab_day_team ADD CONSTRAINT FK_B58460F49C1AC772 FOREIGN KEY (lab_day_id) REFERENCES lab_day (id)');
        $this->addSql('ALTER TABLE personal_skill ADD CONSTRAINT FK_664A2619D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE personal_skill ADD CONSTRAINT FK_664A2615A6C0D6B FOREIGN KEY (skill_id_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE skill_certification_vote ADD CONSTRAINT FK_8DB2F7F9D9D30CA FOREIGN KEY (certified_personal_skill_id) REFERENCES personal_skill (id)');
        $this->addSql('ALTER TABLE skill_certification_vote_user ADD CONSTRAINT FK_1A603EFD3AF1D964 FOREIGN KEY (skill_certification_vote_id) REFERENCES skill_certification_vote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_certification_vote_user ADD CONSTRAINT FK_1A603EFDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE social_network ADD CONSTRAINT FK_EFFF5221A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team_user ADD CONSTRAINT FK_5C722232296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_user ADD CONSTRAINT FK_5C722232A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD lab_day_team_id INT DEFAULT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD avatar VARCHAR(255) DEFAULT NULL, ADD company VARCHAR(255) DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, ADD personal_project LONGTEXT DEFAULT NULL, CHANGE username first_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495BA43217 FOREIGN KEY (lab_day_team_id) REFERENCES lab_day_team (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6495BA43217 ON user (lab_day_team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lab_day_team DROP FOREIGN KEY FK_B58460F49C1AC772');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495BA43217');
        $this->addSql('ALTER TABLE skill_certification_vote DROP FOREIGN KEY FK_8DB2F7F9D9D30CA');
        $this->addSql('ALTER TABLE personal_skill DROP FOREIGN KEY FK_664A2615A6C0D6B');
        $this->addSql('ALTER TABLE skill_certification_vote_user DROP FOREIGN KEY FK_1A603EFD3AF1D964');
        $this->addSql('ALTER TABLE team_user DROP FOREIGN KEY FK_5C722232296CD8AE');
        $this->addSql('DROP TABLE lab_day');
        $this->addSql('DROP TABLE lab_day_team');
        $this->addSql('DROP TABLE personal_skill');
        $this->addSql('DROP TABLE school_class');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_certification_vote');
        $this->addSql('DROP TABLE skill_certification_vote_user');
        $this->addSql('DROP TABLE social_network');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_user');
        $this->addSql('DROP INDEX IDX_8D93D6495BA43217 ON user');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP lab_day_team_id, DROP first_name, DROP last_name, DROP avatar, DROP company, DROP description, DROP personal_project');
    }
}
