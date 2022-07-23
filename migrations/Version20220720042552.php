<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720042552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE telefone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE usuario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE telefone (id INT NOT NULL, data_criacao DATE NOT NULL, data_atualizacao DATE NOT NULL, ddd VARCHAR(3) NOT NULL, numero VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE usuario (id INT NOT NULL, lista_telefones_id INT NOT NULL, data_criacao DATE NOT NULL, data_atualizacao DATE NOT NULL, nome VARCHAR(30) NOT NULL, data_nascimento DATE NOT NULL, email VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2265B05DF8E02968 ON usuario (lista_telefones_id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DF8E02968 FOREIGN KEY (lista_telefones_id) REFERENCES telefone (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE usuario DROP CONSTRAINT FK_2265B05DF8E02968');
        $this->addSql('DROP SEQUENCE telefone_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE usuario_id_seq CASCADE');
        $this->addSql('DROP TABLE telefone');
        $this->addSql('DROP TABLE usuario');
    }
}
