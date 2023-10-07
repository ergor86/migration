<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CriaTabelaEstado extends AbstractMigration
{
    public function up(): void {
        $sql = <<<'SQL'
            CREATE TABLE estado (
                id INT NOT NULL AUTO_INCREMENT,
                nome VARCHAR(60) NOT NULL,
                pais_id INT NOT NULL,
                CONSTRAINT pk_estado PRIMARY KEY ( id ),
                CONSTRAINT unq_estado__nome UNIQUE ( nome ),
                CONSTRAINT fk_estado__pais_id FOREIGN KEY ( pais_id )
                    REFERENCES pais ( id ) ON UPDATE CASCADE ON DELETE RESTRICT
            ) ENGINE=INNODB
        SQL;
        $this->execute( $sql );
    }

    public function down(): void {
        $sql = <<<'SQL'
            DROP TABLE estado
        SQL;
        $this->execute( $sql );
    }
}
