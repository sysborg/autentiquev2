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

        /**
         * @description-en-US       Verify if the variable is not null and not ''
         * @description-pt-BR       Verifica se a variável não está nula e não é ''
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $variableName
         * @param                   mixed $val
         * @return                  void
         */
        public function verifyFill(string $variableName, $val) : void
        {
            if(is_null($val) || $val=='')
                throw new \Exception('en-US: Variable '. $variableName. ' can\'t be null or empty, please set a valid value! | pt-BR: A variável '. $variableName. ' não pode ser nula ou vazia, por favor preencha a variável com um valor válido!');
        }
    }
?>
