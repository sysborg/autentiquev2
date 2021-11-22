<?php
    namespace sysborg\autentiquev2;

    interface layouts{
        /**
         * @description-en-US       Set expected and possible values to the layout
         * @description-pt-BR       Seta valores esperados e possíveis ao layout
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $apiInfoName
         * @param                   mixed  $val
         * @return                  void
         */
        public function __set(string $apiInfoName, $val);

        /**
         * @description-en-US       Get setted values of the layout
         * @description-pt-BR       Pega valores setados ao layout
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $apiInfoName
         * @return                  mixed
         */
        public function __get(string $apiInfoName);

        /**
         * @description-en-US       Parse the values on the graphql schema and returns as string
         * @description-pt-BR       Parse os valores no schema do graphql e retorna como string
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   
         * @return                  string
         */
        public function parse() : string | array;
    }
?>
