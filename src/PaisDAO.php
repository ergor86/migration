<?php
require_once "src/Pais.php";
class PaisDAO {

    private $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    public function comId( int $id ) {
        $ps = $this->pdo->prepare( 'SELECT * FROM pais WHERE id = ?' );
        $ps->execute( [ $id ] );
        $ps->setFetchMode( PDO::FETCH_CLASS, 'Pais' );
        $pais = $ps->fetch();

       return $pais === false ? null : $pais;
    
    }
}