<?php
declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

    class SemeadorInicial extends AbstractSeed {
        public function getDependencies(): array {
            return [];
        }

        public function run(): void {
            $sql = <<<SQL
                DELETE FROM cidade;
                DELETE FROM estado;
                DELETE FROM pais;

            SQL;
            $this->execute($sql);
        }
    }


?>