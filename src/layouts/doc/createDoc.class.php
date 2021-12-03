<?php
    namespace sysborg\autentiquev2;

class createDoc extends common implements \sysborg\autentiquev2\layouts{
        /**
         * @description-en-US:       Stores informations and variables for this layout
         * @description-pt-BR:       Armazena informações e variáveis para esse layout
         * @var                      array
         */
        protected array $layoutInfo = [
            'name' => NULL,
            'file' => NULL
        ];

        /**
         * @description-en-US:       Store information about signers
         * @description-pt-BR:       Armazena informações dos assinantes
         * @var                      array
         */
        protected array $signers = [];

        /**
         * @description-en-US:       Stores the query of graphql
         * @description-pt-BR:       Armazena a query do graphql
         * @var                      string
         */
        protected string $query = '{
            "query": "mutation CreateDocumentMutation( $document: DocumentInput!, $signers: [SignerInput!]!, $file: Upload! ) { createDocument( document: $document, signers: $signers, file: $file ) { id name refusable sortable created_at signatures { public_id name email created_at action { name } link { short_link } user { id name email } } } }",
            "variables": { "document": { "name": "%s" }, "signers": %s, "file": null }
        }';

        /**
         * @description-en-US       Add signers to the doc with first sign position
         * @description-pt-BR       Adiciona assinantes ao documento com a primeira posição de assinatura
         * author                   Anderson Arruda < andmarruda@gmail.com >
         * version                  1.0.0
         * access                   public
         * param                    string $email - "Email of the signer | Email do assinante"
         * return                   docSignaturePosition
         */
        public function addSigners(string $email) : docSignaturePosition
        {
            $this->verifyEmail('email', $email);
            $positions = new docSignaturePosition();
            array_push($this->signers, [
                'email'     => $email,
                'action'    => 'SIGN',
                'positionsObject' => $positions
            ]);

            return $positions;
        }

        /**
         * @description-en-US       Prepare signers to the parse
         * @description-pt-BR       Prepara signatários para o parse
         * author                   Anderson Arruda < andmarruda@gmail.com >
         * param                    
         * return                   array
         */
        public function signersToParse() : array
        {
            $signers = $this->signers;
            foreach($signers as $k => $signer){
                $pos = $signer['positionsObject']->getPositions();
                if(count($pos) > 0)
                    $signers[$k]['positions'] = $pos;

                unset($signers[$k]['positionsObject']);
            }

            return $signers;
        }

        /**
         * @description-en-US       Parse the values on the graphql schema and returns as string
         * @description-pt-BR       Parse os valores no schema do graphql e retorna como string
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   
         * @return                  array
         */
        public function parse() : array
        {
            $this->verifyFill('name', $this->name);
            $this->verifyFill('file', $this->file);
            $this->verifyFile('file', $this->file);
            $this->verifyArray('signers', $this->signers);

            $query = sprintf($this->query, $this->name, json_encode($this->signersToParse()));

            $arr = [
                'operations' => $query,
                'map'        => '{"file": ["variables.file"]}',
                'file'       => new \CURLFile($this->file)
            ];

            return $arr;
        }
    }
?>
