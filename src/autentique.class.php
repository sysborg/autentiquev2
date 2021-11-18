<?php
    namespace sysborg\autentiquev2;

    class autentique{
        /**
         * @description-en-US:       Stores API's informations
         * @description-pt-BR:       Armazena as informações da API
         * @var                      array
         */
        private array $apiInfo = [
            'url'       => 'https://api.autentique.com.br/v2/graphql',
            'token'     => NULL,
            'devMode'   => false
        ];

        /**
         * @description-en-US:       Store path for autoload
         * @description-pt-BR:       Armazena caminhos para o autoload
         * @var                      array
         */
        private static array $loadPath = [
            'sysborg\autentiquev2\layouts' => '/layouts.interface.php',
            'sysborg\autentiquev2\listDir' => '/layouts/dir/listDir.class.php'
        ];

        /**
         * @description-en-US       Construct the class with the desired layout
         * @description-pt-BR       Constrói a classe com o layout desejado
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   private \sysborg\autentiquev2\layouts $layout
         * @return                  string
         */
        public function __construct(private \sysborg\autentiquev2\layouts $layout){}

        /**
         * @description-en-US       Get class's paths
         * @description-pt-BR       Pega os caminhos da classe
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $className
         * @return                  string
         */
        public static function getClassPath(string $className) : string
        {
            return self::$loadPath[$className];
        }

        /**
         * @description-en-US       Set values to API's informations
         * @description-pt-BR       Seta valores para as informações da API
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $apiInfoName
         * @param                   mixed  $val
         * @return                  void
         */
        public function __set(string $apiInfoName, $val)
        {
            $keys = array_keys($this->apiInfo);
            if(array_search($apiInfoName, $keys)===-1)
                throw new \Exception('en-US: No variable '. $apiInfoName. ' has been founded! Verify the name and try again! | pt-BR: Nenhuma variável com o nome '. $apiInfoName. ' foi encontrada! Verifique o nome e tente novamente!');

            if($apiInfoName==='devMode' && !is_bool($val))
                throw new \Exception('en-US: devMode expects boolean and '. gettype($val). ' are given! | pt-BR: devMode espera boolean e '. gettype($val). ' foi passado!');

            $this->apiInfo[$apiInfoName] = $val;
        }

        /**
         * @description-en-US       Get values to API's informations
         * @description-pt-BR       Pega valores para as informações da API
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $apiInfoName
         * @return                  mixed
         */
        public function __get(string $apiInfoName)
        {
            $keys = array_keys($this->apiInfo);
            if(array_search($apiInfoName, $keys)===-1)
                throw new \Exception('en-US: No variable '. $apiInfoName. ' has been founded! Verify the name and try again! | pt-BR: Nenhuma variável com o nome '. $apiInfoName. ' foi encontrada! Verifique o nome e tente novamente!');

            return $this->apiInfo[$apiInfoName];
        }

        /**
         * @description-en-US       Transmit requisition of Autentique API
         * @description-pt-BR       Transmite a requisção da API do Autentique
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   
         * @return                  mixed
         */
        public function transmit()
        {
            $c=curl_init();
            curl_setopt_array($c, [
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>$this->layout->parse(),
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer '. $this->token,
                    'Content-Type: application/json'
                ]
            ]);
            $r = curl_exec($c);
            curl_close($c);
            return $r;
        }
    }

    spl_autoload_register(function($cls){
        require_once __DIR__. \sysborg\autentiquev2\autentique::getClassPath($cls);
    });
?>
