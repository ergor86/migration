
<?php
use Phinx\Console\PhinxApplication;
use Phinx\Config\Config;
use Phinx\Migration\Manager;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;
require_once('/Users/usuario/Desktop/Migration/src/PaisDAO.php');

function criarPDO( array $p ): PDO {
    $adapter = $p[ 'adapter' ] ?? 'mysql';
    $dbname = $p[ 'name' ] ?? 'SEM_BANCO';
    $host = $p[ 'host' ] ?? 'localhost';
    $port = $p[ 'port' ] ?? '3306';
    $charset = $p[ 'charset' ] ?? 'utf8';
    $dsn = "$adapter:host=$host;dbname=$dbname;charset=$charset;port=$port";
    $usuario = $p[ 'user' ] ?? '';
    $senha = $p[ 'pass' ] ?? '';
    $opcoes = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];
    return new PDO( $dsn, $usuario, $senha, $opcoes );
}

describe( 'PaisDAO', function() {

    beforeAll( function() {
        // Carrega a configuração do arquivo
        $configArray = require_once( 'phinx.php' );
        $env = 'testing';

        // Via CLI --------------------------------------------
        // exec( "php vendor/bin/phinx migrate -e $env" );
        // exec( "php vendor/bin/phinx seed:run -e $env" );
        // ----------------------------------------------------

        // Via Manager -----------------------------------------
        // $manager = new Manager( new Config( $configArray ),
        //   new StringInput( ' ' ), new NullOutput() );
        // // Roda o Migrador para uma configuração
        // $manager->migrate( $env );
        // // Roda o Semeador para uma configuração
        // $manager->seed( $env );
        // ----------------------------------------------------

        // Via PhinxApplication -------------------------------
        $app = new PhinxApplication();
        $app->setAutoExit( false );
        // Migração
        $app->run( new StringInput( "migrate -e $env" ), new NullOutput() );
        // Semeadura
        $app->run( new StringInput( "seed -e $env" ), new NullOutput() );
        // ----------------------------------------------------

        // Aproveita uma configuração para criar PDO
        $dbParams = $configArray[ 'environments' ][ $env ];
        $this->pdo = criarPDO( $dbParams );

        $this->repositorio = new PaisDAO( $this->pdo );
    } );

    it( 'carrega um país pelo id', function() {
        $idPais = $this->pdo->query(
            "SELECT id FROM pais WHERE nome = 'Brasil'" )->fetch()[ 'id' ];
        $pais = $this->repositorio->comId( $idPais );
        expect( $pais )->not->toBeNull();
        expect( $pais )->toBeAnInstanceOf( 'Pais' );
    } );

} );