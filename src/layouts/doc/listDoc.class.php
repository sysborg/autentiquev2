<?php
    namespace sysborg\autentiquev2;

    class listDoc extends common implements \sysborg\autentiquev2\layouts{
        /**
         * @description-en-US:       Stores informations and variables for this layout
         * @description-pt-BR:       Armazena informações e variáveis para esse layout
         * @var                      array
         */
        protected array $layoutInfo = [
            'limit' => 60,
            'page' => 1
        ];

        /**
         * @description-en-US:       Stores the query of graphql
         * @description-pt-BR:       Armazena a query do graphql
         * @var                      string
         */
        private string $query = '{
            "query": "query { documents(limit: %d, page: %d) { total data { id name refusable sortable created_at signatures { public_id name email created_at action { name } link { short_link } user { id name email } viewed { created_at } signed { created_at } rejected { created_at } } files { original signed } } } }",
            "variables": {}
        }';

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
