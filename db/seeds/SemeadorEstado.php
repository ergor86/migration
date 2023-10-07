<?php


use Phinx\Seed\AbstractSeed;

class SemeadorEstado extends AbstractSeed
{
    
    public function getDependencies(): array {
        return [ 'SemeadorPais' ];
    }

    public function run(): void
    {
        $idBrasil = $this->fetchRow( "SELECT id FROM pais WHERE nome = 'Brasil'" )[ 'id' ];
        $sql = <<<SQL
            DELETE FROM estado;

            INSERT INTO estado ( id, nome, pais_id ) VALUES
            ( NULL, 'Rio de Janeiro', $idBrasil ),
            ( NULL, 'São Paulo', $idBrasil );
        SQL;
        $this->execute( $sql );
    }
}
