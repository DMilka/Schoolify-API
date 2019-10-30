<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191030202525 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE attendance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, attendance_form_id_id INTEGER NOT NULL, student_id_id INTEGER NOT NULL, value BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6DE30D913A7A678C ON attendance (attendance_form_id_id)');
        $this->addSql('CREATE INDEX IDX_6DE30D91F773E7CA ON attendance (student_id_id)');
        $this->addSql('CREATE TABLE attendance_form (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id_id INTEGER NOT NULL, date DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6A56203A7648EE39 ON attendance_form (module_id_id)');
        $this->addSql('CREATE TABLE average_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(64) NOT NULL, type VARCHAR(64) NOT NULL)');
        $this->addSql('CREATE TABLE mark (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER NOT NULL, markform_id_id INTEGER NOT NULL, value DOUBLE PRECISION DEFAULT NULL, old_value DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_6674F271CB944F1A ON mark (student_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6674F2719DF4D99B ON mark (markform_id_id)');
        $this->addSql('CREATE TABLE mark_form (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id_id INTEGER NOT NULL, name VARCHAR(64) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_872F96AA7648EE39 ON mark_form (module_id_id)');
        $this->addSql('CREATE TABLE module (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, teacher_id_id INTEGER NOT NULL, average_type_id_id INTEGER NOT NULL, name VARCHAR(64) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2426282EBB220A ON module (teacher_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C242628EAE7025E ON module (average_type_id_id)');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id_id INTEGER NOT NULL, name VARCHAR(64) NOT NULL, surname VARCHAR(64) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_B723AF337648EE39 ON student (module_id_id)');
        $this->addSql('CREATE TABLE teacher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(64) NOT NULL, password VARCHAR(64) NOT NULL, name VARCHAR(64) NOT NULL, surname VARCHAR(64) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE attendance');
        $this->addSql('DROP TABLE attendance_form');
        $this->addSql('DROP TABLE average_type');
        $this->addSql('DROP TABLE mark');
        $this->addSql('DROP TABLE mark_form');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE teacher');
    }
}
