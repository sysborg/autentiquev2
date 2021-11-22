<?php
    namespace sysborg\autentiquev2;

    class createDir extends common implements \sysborg\autentiquev2\layouts{
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
        private array $signers = [];

        /**
         * @description-en-US:       Stores the query of graphql
         * @description-pt-BR:       Armazena a query do graphql
         * @var                      string
         */
        private string $query = '{
            "query": "mutation CreateDocumentMutation( $document: DocumentInput!, $signers: [SignerInput!]!, $file: Upload! ) { createDocument( document: $document, signers: $signers, file: $file ) { id name refusable sortable created_at signatures { public_id name email created_at action { name } link { short_link } user { id name email } } } }",
            "variables": { "document": { "name": "%s" }, "signers": [%s], "file" => "%s" }
        }';

        /**
         * {
            * "email": "troque-esse-email-que-e-publico@tuamaeaquelaursa.com",
            * "action": "SIGN",
            'positions' => [
                        [
                            'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                            'y' => '80', // Posição do Eixo Y da ASSINATURA (0 a 100)
                            'z' => '1', // Página da ASSINATURA
                        ],
                        [
                            'x' => '50', // Posição do Eixo X da ASSINATURA (0 a 100)
                            'y' => '50', // Posição do Eixo Y da ASSINATURA (0 a 100)
                            'z' => '2', // Página da ASSINATURA
                        ],
                    ],
         * }
         */

        /**
         * @description-en-US       Add signers to the doc with first sign position
         * @description-pt-BR       Adiciona assinantes ao documento com a primeira posição de assinatura
         * author                   Anderson Arruda < andmarruda@gmail.com >
         * version                  1.0.0
         * access                   public
         * param                    string $email - "Email of the signer | Email do assinante"
         * param                    int $x        - "X axis of the signature | eixo x da assinatura"
         * param                    int $y        - "Y axis of the signature | eixo y da assinatura"
         * param                    int $z        - "Z is the page of signatura | Z é a página da assinatura"
         * return                   object
         */
        public function addSigners(string $email, int $x, int $y, int $z) : object
        {
            $this->verifyEmail('email', $email);
            $idx = array_push($this->signers, [
                'email'     => $email,
                'action'    => 'SIGN',
                'positions' => [[
                    'x' => $x,
                    'y' => $y,
                    'z' => $x
                ]]
            ]);

            return new class($this->signers[$idx]){
                /**
                 * @description-en-US:       Store information about actual signer
                 * @description-pt-BR:       Armazena informações sobre o assinante atual
                 * @var                      array
                 */
                private array $signer;

                /**
                 * @description-en-US       Recieves the actual signer's dimension opening possibility to add new sign positions
                 * @description-pt-BR       Recebe a dimensão assinante atual abrindo a possibilidade para adicionar novas posições de assinatura
                 * author                   Anderson Arruda < andmarruda@gmail.com >
                 * version                  1.0.0
                 * access                   public
                 * param                    int $x        - "X axis of the signature | eixo x da assinatura"
                 * param                    int $y        - "Y axis of the signature | eixo y da assinatura"
                 * param                    int $z        - "Z is the page of signatura | Z é a página da assinatura"
                 * return                   void
                 */
                public function __construct(&$signer){
                    $this->signer = $signer;
                }

                /**
                 * @description-en-US       Add sign postion to existings signer
                 * @description-pt-BR       Adiciona uma posição de assinatura a um assinante existente
                 * author                   Anderson Arruda < andmarruda@gmail.com >
                 * version                  1.0.0
                 * access                   public
                 * param                    int $x        - "X axis of the signature | eixo x da assinatura"
                 * param                    int $y        - "Y axis of the signature | eixo y da assinatura"
                 * param                    int $z        - "Z is the page of signatura | Z é a página da assinatura"
                 * return                   void
                 */
                public function addPositions(int $x, int $y, int $z) : void
                {
                    array_push($this->signer['positions'], [
                        'x' => $x,
                        'y' => $y,
                        'z' => $x
                    ]);
                }
            };
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
            $this->verifyFill('file', $this->file);
            $this->verifyFile('file', $this->file);
            $this->verifyArray('signers', $this->signers);

            return sprintf($this->query, $this->name);
        }
    }
?>
