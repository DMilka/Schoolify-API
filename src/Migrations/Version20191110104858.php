<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191110104858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_6DE30D91F773E7CA');
        $this->addSql('DROP INDEX IDX_6DE30D913A7A678C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__attendance AS SELECT id, attendance_form_id_id, student_id_id, value FROM attendance');
        $this->addSql('DROP TABLE attendance');
        $this->addSql('CREATE TABLE attendance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, attendance_form_id_id INTEGER NOT NULL, student_id_id INTEGER NOT NULL, value BOOLEAN NOT NULL, CONSTRAINT FK_6DE30D913A7A678C FOREIGN KEY (attendance_form_id_id) REFERENCES attendance_form (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6DE30D91F773E7CA FOREIGN KEY (student_id_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO attendance (id, attendance_form_id_id, student_id_id, value) SELECT id, attendance_form_id_id, student_id_id, value FROM __temp__attendance');
        $this->addSql('DROP TABLE __temp__attendance');
        $this->addSql('CREATE INDEX IDX_6DE30D91F773E7CA ON attendance (student_id_id)');
        $this->addSql('CREATE INDEX IDX_6DE30D913A7A678C ON attendance (attendance_form_id_id)');
        $this->addSql('DROP INDEX IDX_6A56203A7648EE39');
        $this->addSql('CREATE TEMPORARY TABLE __temp__attendance_form AS SELECT id, module_id_id, date FROM attendance_form');
        $this->addSql('DROP TABLE attendance_form');
        $this->addSql('CREATE TABLE attendance_form (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id_id INTEGER NOT NULL, date DATE NOT NULL, CONSTRAINT FK_6A56203A7648EE39 FOREIGN KEY (module_id_id) REFERENCES module (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO attendance_form (id, module_id_id, date) SELECT id, module_id_id, date FROM __temp__attendance_form');
        $this->addSql('DROP TABLE __temp__attendance_form');
        $this->addSql('CREATE INDEX IDX_6A56203A7648EE39 ON attendance_form (module_id_id)');
        $this->addSql('DROP INDEX UNIQ_6674F2719DF4D99B');
        $this->addSql('DROP INDEX IDX_6674F271CB944F1A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__mark AS SELECT id, student_id, markform_id_id, value, old_value FROM mark');
        $this->addSql('DROP TABLE mark');
        $this->addSql('CREATE TABLE mark (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER NOT NULL, markform_id_id INTEGER NOT NULL, value DOUBLE PRECISION DEFAULT NULL, old_value DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_6674F271CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6674F2719DF4D99B FOREIGN KEY (markform_id_id) REFERENCES mark_form (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO mark (id, student_id, markform_id_id, value, old_value) SELECT id, student_id, markform_id_id, value, old_value FROM __temp__mark');
        $this->addSql('DROP TABLE __temp__mark');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6674F2719DF4D99B ON mark (markform_id_id)');
        $this->addSql('CREATE INDEX IDX_6674F271CB944F1A ON mark (student_id)');
        $this->addSql('DROP INDEX IDX_872F96AA7648EE39');
        $this->addSql('CREATE TEMPORARY TABLE __temp__mark_form AS SELECT id, module_id_id, name FROM mark_form');
        $this->addSql('DROP TABLE mark_form');
        $this->addSql('CREATE TABLE mark_form (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id_id INTEGER NOT NULL, name VARCHAR(64) NOT NULL COLLATE BINARY, CONSTRAINT FK_872F96AA7648EE39 FOREIGN KEY (module_id_id) REFERENCES module (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO mark_form (id, module_id_id, name) SELECT id, module_id_id, name FROM __temp__mark_form');
        $this->addSql('DROP TABLE __temp__mark_form');
        $this->addSql('CREATE INDEX IDX_872F96AA7648EE39 ON mark_form (module_id_id)');
        $this->addSql('DROP INDEX UNIQ_C242628EAE7025E');
        $this->addSql('DROP INDEX UNIQ_C2426282EBB220A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__module AS SELECT id, teacher_id_id, average_type_id_id, name, start_date, end_date, class_name FROM module');
        $this->addSql('DROP TABLE module');
        $this->addSql('CREATE TABLE module (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, teacher_id_id INTEGER NOT NULL, average_type_id_id INTEGER NOT NULL, name VARCHAR(64) NOT NULL COLLATE BINARY, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, class_name VARCHAR(64) NOT NULL COLLATE BINARY, CONSTRAINT FK_C2426282EBB220A FOREIGN KEY (teacher_id_id) REFERENCES teacher (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C242628EAE7025E FOREIGN KEY (average_type_id_id) REFERENCES average_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO module (id, teacher_id_id, average_type_id_id, name, start_date, end_date, class_name) SELECT id, teacher_id_id, average_type_id_id, name, start_date, end_date, class_name FROM __temp__module');
        $this->addSql('DROP TABLE __temp__module');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C242628EAE7025E ON module (average_type_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2426282EBB220A ON module (teacher_id_id)');
        $this->addSql('DROP INDEX IDX_B723AF337648EE39');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, module_id_id, name, surname FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id_id INTEGER NOT NULL, name VARCHAR(64) NOT NULL COLLATE BINARY, surname VARCHAR(64) NOT NULL COLLATE BINARY, CONSTRAINT FK_B723AF337648EE39 FOREIGN KEY (module_id_id) REFERENCES module (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO student (id, module_id_id, name, surname) SELECT id, module_id_id, name, surname FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('CREATE INDEX IDX_B723AF337648EE39 ON student (module_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_6DE30D913A7A678C');
        $this->addSql('DROP INDEX IDX_6DE30D91F773E7CA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__attendance AS SELECT id, attendance_form_id_id, student_id_id, value FROM attendance');
        $this->addSql('DROP TABLE attendance');
        $this->addSql('CREATE TABLE attendance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, attendance_form_id_id INTEGER NOT NULL, student_id_id INTEGER NOT NULL, value BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO attendance (id, attendance_form_id_id, student_id_id, value) SELECT id, attendance_form_id_id, student_id_id, value FROM __temp__attendance');
        $this->addSql('DROP TABLE __temp__attendance');
        $this->addSql('CREATE INDEX IDX_6DE30D913A7A678C ON attendance (attendance_form_id_id)');
        $this->addSql('CREATE INDEX IDX_6DE30D91F773E7CA ON attendance (student_id_id)');
        $this->addSql('DROP INDEX IDX_6A56203A7648EE39');
        $this->addSql('CREATE TEMPORARY TABLE __temp__attendance_form AS SELECT id, module_id_id, date FROM attendance_form');
        $this->addSql('DROP TABLE attendance_form');
        $this->addSql('CREATE TABLE attendance_form (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id_id INTEGER NOT NULL, date DATE NOT NULL)');
        $this->addSql('INSERT INTO attendance_form (id, module_id_id, date) SELECT id, module_id_id, date FROM __temp__attendance_form');
        $this->addSql('DROP TABLE __temp__attendance_form');
        $this->addSql('CREATE INDEX IDX_6A56203A7648EE39 ON attendance_form (module_id_id)');
        $this->addSql('DROP INDEX IDX_6674F271CB944F1A');
        $this->addSql('DROP INDEX UNIQ_6674F2719DF4D99B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__mark AS SELECT id, student_id, markform_id_id, value, old_value FROM mark');
        $this->addSql('DROP TABLE mark');
        $this->addSql('CREATE TABLE mark (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER NOT NULL, markform_id_id INTEGER NOT NULL, value DOUBLE PRECISION DEFAULT NULL, old_value DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('INSERT INTO mark (id, student_id, markform_id_id, value, old_value) SELECT id, student_id, markform_id_id, value, old_value FROM __temp__mark');
        $this->addSql('DROP TABLE __temp__mark');
        $this->addSql('CREATE INDEX IDX_6674F271CB944F1A ON mark (student_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6674F2719DF4D99B ON mark (markform_id_id)');
        $this->addSql('DROP INDEX IDX_872F96AA7648EE39');
        $this->addSql('CREATE TEMPORARY TABLE __temp__mark_form AS SELECT id, module_id_id, name FROM mark_form');
        $this->addSql('DROP TABLE mark_form');
        $this->addSql('CREATE TABLE mark_form (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id_id INTEGER NOT NULL, name VARCHAR(64) NOT NULL)');
        $this->addSql('INSERT INTO mark_form (id, module_id_id, name) SELECT id, module_id_id, name FROM __temp__mark_form');
        $this->addSql('DROP TABLE __temp__mark_form');
        $this->addSql('CREATE INDEX IDX_872F96AA7648EE39 ON mark_form (module_id_id)');
        $this->addSql('DROP INDEX UNIQ_C2426282EBB220A');
        $this->addSql('DROP INDEX UNIQ_C242628EAE7025E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__module AS SELECT id, teacher_id_id, average_type_id_id, name, start_date, end_date, class_name FROM module');
        $this->addSql('DROP TABLE module');
        $this->addSql('CREATE TABLE module (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, teacher_id_id INTEGER NOT NULL, average_type_id_id INTEGER NOT NULL, name VARCHAR(64) NOT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, class_name VARCHAR(64) NOT NULL)');
        $this->addSql('INSERT INTO module (id, teacher_id_id, average_type_id_id, name, start_date, end_date, class_name) SELECT id, teacher_id_id, average_type_id_id, name, start_date, end_date, class_name FROM __temp__module');
        $this->addSql('DROP TABLE __temp__module');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2426282EBB220A ON module (teacher_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C242628EAE7025E ON module (average_type_id_id)');
        $this->addSql('DROP INDEX IDX_B723AF337648EE39');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, module_id_id, name, surname FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, module_id_id INTEGER NOT NULL, name VARCHAR(64) NOT NULL, surname VARCHAR(64) NOT NULL)');
        $this->addSql('INSERT INTO student (id, module_id_id, name, surname) SELECT id, module_id_id, name, surname FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('CREATE INDEX IDX_B723AF337648EE39 ON student (module_id_id)');
    }
}
