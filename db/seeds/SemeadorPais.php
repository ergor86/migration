<?php


use Phinx\Seed\AbstractSeed;

class SemeadorPais extends AbstractSeed
{
    public function getDependencies(): array
    {
        return ['SemeadorInicial'];
    }
    public function run(): void {
        $sql = <<<'SQL'
            DELETE FROM pais;

            INSERT INTO pais (id, nome) VALUES
            (NULL, 'Brasil'),
            (NULL, 'Argentina');
        SQL;
        $this->execute($sql);
    }
}
