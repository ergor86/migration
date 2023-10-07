<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CriaTabelaCidade extends AbstractMigration {
    public function up(): void{
        $sql = <<<'SQL'
        CREATE TABLE cidade (
          id INT NOT NULL AUTO_INCREMENT,
          nome VARCHAR(60) NOT NULL,
          estado_id INT NOT NULL,
          CONSTRAINT pk_cidade PRIMARY KEY( id ),
          CONSTRAINT unq_cidade__nome UNIQUE( nome ),
          CONSTRAINT fk_cidade__estado_id FOREIGN KEY ( estado_id )
            REFERENCES estado( id ) ON UPDATE CASCADE ON DELETE RESTRICT
        ) ENGINE=INNODB
      SQL;
        $this->execute($sql);
    }
    public function down(): void {
        $this->execute( 'DROP TABLE exemplo' );
      }
}
