<?php
    namespace sysborg\autentiquev2;

    class listDir implements \sysborg\autentiquev2\layouts{
        /**
         * @description-en-US:       Stores informations and variables for this layout
         * @description-pt-BR:       Armazena informações e variáveis para esse layout
         * @var                      array
         */
        private array $layoutInfo = [
            'limit' => 60,
            'page' => 1
        ];

        /**
         * @description-en-US:       Stores the query of graphql
         * @description-pt-BR:       Armazena a query do graphql
         * @var                      string
         */
        private string $query = '{
            "query": "query { folders(limit: %d, page: %d) { total data { id name type created_at } } }",
            "variables": {}
        }';

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
        public function __set(string $layoutInfoName, $val)
        {
            $keys = array_keys($this->layoutInfo);
            if(array_search($layoutInfoName, $keys)===-1)
                throw new \Exception('en-US: No variable '. $layoutInfoName. ' has been founded! Verify the name and try again! | pt-BR: Nenhuma variável com o nome '. $layoutInfoName. ' foi encontrada! Verifique o nome e tente novamente!');

            $this->layoutInfo[$layoutInfoName] = $val;
        }

        /**
         * @description-en-US       Get setted values of the layout
         * @description-pt-BR       Pega valores setados ao layout
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $apiInfoName
         * @return                  mixed
         */
        public function __get(string $layoutInfoName)
        {
            $keys = array_keys($this->layoutInfo);
            if(array_search($layoutInfoName, $keys)===-1)
                throw new \Exception('en-US: No variable '. $layoutInfoName. ' has been founded! Verify the name and try again! | pt-BR: Nenhuma variável com o nome '. $layoutInfoName. ' foi encontrada! Verifique o nome e tente novamente!');

            return $this->layoutInfo[$layoutInfoName];
        }

        /**
         * @description-en-US       Parse the values on the graphql schema and returns as string
         * @description-pt-BR       Parse os valores no schema do graphql e retorna como string
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   
         * @return                  string
         */
        public function parse() : string
        {
            return sprintf($this->query, $this->limit, $this->page);
        }
    }
?>
