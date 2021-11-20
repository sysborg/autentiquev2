<?php
    namespace sysborg\autentiquev2;

    trait utils{
        /**
         * @description-en-US       Verify if column exists inside an array
         * @description-pt-BR       Verifica se uma coluna existe em uma array
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   array $arr
         * @param                   string  $columnName
         * @return                  void
         */
        public function verifyColumn(array $arr, string $columnName) : void
        {
            $keys = array_keys($arr);
            if(array_search($columnName, $keys)===-1)
                throw new \Exception('en-US: No variable '. $columnName. ' has been founded! Verify the name and try again! | pt-BR: Nenhuma variável com o nome '. $columnName. ' foi encontrada! Verifique o nome e tente novamente!');
        }
    }
?>