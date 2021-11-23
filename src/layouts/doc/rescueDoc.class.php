<?php
    namespace sysborg\autentiquev2;

    class rescueDoc extends common implements \sysborg\autentiquev2\layouts{
        /**
         * @description-en-US:       Stores informations and variables for this layout
         * @description-pt-BR:       Armazena informações e variáveis para esse layout
         * @var                      array
         */
        protected array $layoutInfo = [
            'document_id' => ''
        ];

        /**
         * @description-en-US:       Stores the query of graphql
         * @description-pt-BR:       Armazena a query do graphql
         * @var                      string
         */
        private string $query = '{
            "query": "query { document(id: \"%s\") { id name refusable sortable created_at files { original signed } signatures { public_id name email created_at action { name } link { short_link } user { id name email } email_events { sent opened delivered refused reason } viewed { ...event } signed { ...event } rejected { ...event } } } } fragment event on Event { ip port reason created_at geolocation { country countryISO state stateISO city zipcode latitude longitude } }",
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
            return sprintf($this->query, $this->document_id);
        }
    }
?>
