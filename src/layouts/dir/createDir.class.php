<?php
    namespace sysborg\autentiquev2;

    class createDir implements \sysborg\autentiquev2\layouts{
        use utils;

        /**
         * @description-en-US:       Stores informations and variables for this layout
         * @description-pt-BR:       Armazena informações e variáveis para esse layout
         * @var                      array
         */
        private array $layoutInfo = [
            'name' => NULL
        ];

        /**
         * @description-en-US:       Stores the query of graphql
         * @description-pt-BR:       Armazena a query do graphql
         * @var                      string
         */
        private string $query = '{
            "query": "mutation CreateFolderMutation($folder: FolderInput!) { createFolder(folder: $folder) { id name type created_at } }",
            "variables": { "folder": { "name": "%s" } }
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
            $this->verifyColumn($this->layoutInfo, $layoutInfoName);
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
            $this->verifyColumn($this->layoutInfo, $layoutInfoName);
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
            $this->verifyFill('name', $this->name);
            return sprintf($this->query, $this->name);
        }
    }
?>
