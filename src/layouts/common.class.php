<?php
    namespace sysborg\autentiquev2;

    abstract class common{
        use utils;

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
         * @description-en-US       Debug informations for layouts
         * @descritpion-pt-BR       Informações de debug para os layouts
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   
         * @return                  array
         */
        public function __debugInfo() : array
        {
            return [
                'class'        => get_called_class(),
                'variables'    => $this->layoutInfo,
                'signers'      => ((isset($this->signers)) ? $this->signers : NULL),
                'graphqlQuery' => [
                    'formated' => $this->parse(),
                    'normal'   => $this->query
                ]
            ];
        }
    }
?>
