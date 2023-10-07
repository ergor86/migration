<?php
declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class SemeadorCidade extends AbstractSeed {

  public function getDependencies(): array {
    return [ 'SemeadorEstado' ];
  }

  public function run(): void {
    $idEstado = $this->fetchRow( "SELECT id FROM estado WHERE nome = 'Rio de Janeiro'" )[ 'id' ];
    $sql = <<<SQL
      DELETE FROM cidade;

      INSERT INTO cidade ( id, nome, estado_id ) VALUES
      ( NULL, 'Nova Friburgo', $idEstado ),
      ( NULL, 'Cantagalo', $idEstado ),
      ( NULL, 'Bom Jardim', $idEstado );
    SQL;
    $this->execute( $sql );
  }
}
?>
