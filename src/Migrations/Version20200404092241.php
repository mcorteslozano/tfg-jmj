<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200404092241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_183C316535AEE23E');
        $this->addSql('DROP INDEX IDX_183C3165C861D91D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__linea_pedido AS SELECT id, id_articulo_id, id_pedido_id, unidades, precio_linea FROM linea_pedido');
        $this->addSql('DROP TABLE linea_pedido');
        $this->addSql('CREATE TABLE linea_pedido (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_articulo_id INTEGER DEFAULT NULL, id_pedido_id INTEGER DEFAULT NULL, unidades INTEGER NOT NULL, precio_linea DOUBLE PRECISION NOT NULL, CONSTRAINT FK_183C316535AEE23E FOREIGN KEY (id_articulo_id) REFERENCES articulo (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_183C3165C861D91D FOREIGN KEY (id_pedido_id) REFERENCES pedido (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO linea_pedido (id, id_articulo_id, id_pedido_id, unidades, precio_linea) SELECT id, id_articulo_id, id_pedido_id, unidades, precio_linea FROM __temp__linea_pedido');
        $this->addSql('DROP TABLE __temp__linea_pedido');
        $this->addSql('CREATE INDEX IDX_183C316535AEE23E ON linea_pedido (id_articulo_id)');
        $this->addSql('CREATE INDEX IDX_183C3165C861D91D ON linea_pedido (id_pedido_id)');
        $this->addSql('DROP INDEX IDX_C4EC16CEE8F12801');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pedido AS SELECT id, id_proveedor_id, fecha_pedido, fecha_entrega FROM pedido');
        $this->addSql('DROP TABLE pedido');
        $this->addSql('CREATE TABLE pedido (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_proveedor_id INTEGER DEFAULT NULL, fecha_pedido DATE NOT NULL, fecha_entrega DATE NOT NULL, CONSTRAINT FK_C4EC16CEE8F12801 FOREIGN KEY (id_proveedor_id) REFERENCES proveedor (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO pedido (id, id_proveedor_id, fecha_pedido, fecha_entrega) SELECT id, id_proveedor_id, fecha_pedido, fecha_entrega FROM __temp__pedido');
        $this->addSql('DROP TABLE __temp__pedido');
        $this->addSql('CREATE INDEX IDX_C4EC16CEE8F12801 ON pedido (id_proveedor_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__usuario AS SELECT id, email, roles, password, nombre, nombre_usuario, telefono, foto FROM usuario');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('CREATE TABLE usuario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, nombre VARCHAR(50) NOT NULL COLLATE BINARY, nombre_usuario VARCHAR(30) NOT NULL COLLATE BINARY, telefono INTEGER NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , foto VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO usuario (id, email, roles, password, nombre, nombre_usuario, telefono, foto) SELECT id, email, roles, password, nombre, nombre_usuario, telefono, foto FROM __temp__usuario');
        $this->addSql('DROP TABLE __temp__usuario');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DE7927C74 ON usuario (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_183C316535AEE23E');
        $this->addSql('DROP INDEX IDX_183C3165C861D91D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__linea_pedido AS SELECT id, id_articulo_id, id_pedido_id, unidades, precio_linea FROM linea_pedido');
        $this->addSql('DROP TABLE linea_pedido');
        $this->addSql('CREATE TABLE linea_pedido (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_articulo_id INTEGER DEFAULT NULL, id_pedido_id INTEGER DEFAULT NULL, unidades INTEGER NOT NULL, precio_linea DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO linea_pedido (id, id_articulo_id, id_pedido_id, unidades, precio_linea) SELECT id, id_articulo_id, id_pedido_id, unidades, precio_linea FROM __temp__linea_pedido');
        $this->addSql('DROP TABLE __temp__linea_pedido');
        $this->addSql('CREATE INDEX IDX_183C316535AEE23E ON linea_pedido (id_articulo_id)');
        $this->addSql('CREATE INDEX IDX_183C3165C861D91D ON linea_pedido (id_pedido_id)');
        $this->addSql('DROP INDEX IDX_C4EC16CEE8F12801');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pedido AS SELECT id, id_proveedor_id, fecha_pedido, fecha_entrega FROM pedido');
        $this->addSql('DROP TABLE pedido');
        $this->addSql('CREATE TABLE pedido (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_proveedor_id INTEGER DEFAULT NULL, fecha_pedido DATE NOT NULL, fecha_entrega DATE NOT NULL)');
        $this->addSql('INSERT INTO pedido (id, id_proveedor_id, fecha_pedido, fecha_entrega) SELECT id, id_proveedor_id, fecha_pedido, fecha_entrega FROM __temp__pedido');
        $this->addSql('DROP TABLE __temp__pedido');
        $this->addSql('CREATE INDEX IDX_C4EC16CEE8F12801 ON pedido (id_proveedor_id)');
        $this->addSql('DROP INDEX UNIQ_2265B05DE7927C74');
        $this->addSql('CREATE TEMPORARY TABLE __temp__usuario AS SELECT id, email, roles, password, nombre, nombre_usuario, telefono, foto FROM usuario');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('CREATE TABLE usuario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, nombre VARCHAR(50) NOT NULL, nombre_usuario VARCHAR(30) NOT NULL, telefono INTEGER NOT NULL, roles CLOB NOT NULL COLLATE BINARY, foto VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO usuario (id, email, roles, password, nombre, nombre_usuario, telefono, foto) SELECT id, email, roles, password, nombre, nombre_usuario, telefono, foto FROM __temp__usuario');
        $this->addSql('DROP TABLE __temp__usuario');
    }
}
