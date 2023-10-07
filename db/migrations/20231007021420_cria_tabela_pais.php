<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CriaTabelaPais extends AbstractMigration
{
    public function up(): void {
        $sql = <<<'SQL'
            CREATE TABLE pais (
                id INT NOT NULL AUTO_INCREMENT,
                nome VARCHAR(60) NOT NULL,
                CONSTRAINT pk_pais PRIMARY KEY ( id ),
                CONSTRAINT unq_pais__nome UNIQUE ( nome )
            ) ENGINE=INNODB
        SQL;
        $this->execute( $sql );
    }

    public function down(): void {
        $sql = <<<'SQL'
            DROP TABLE pais
        SQL;
        $this->execute( $sql );
    }
   
}
