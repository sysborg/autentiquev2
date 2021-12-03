<?php
    namespace sysborg\autentiquev2;

class docSignaturePosition{
        /**
         * @description-en-US:       Signature's positions
         * @description-pt-BR:       Posições de assinaturas
         * @var                      array
         */
        private array $positions = [];

        /**
         * @description-en-US:       Possible signature's types
         * @description-pt-BR:       Tipos de assinaturas possíveis
         * @var                      array
         */
        private array $availableElements = ['SIGNATURE', 'NAME', 'INITIALS', 'DATE', 'CPF'];

        /**
         * @description-en-US       Add positions to the signer's info
         * @description-pt-BR       Adiciona posições de assinatura as informações do assinante
         * author                   Anderson Arruda < andmarruda@gmail.com >
         * version                  1.0.0
         * access                   public
         * param                    float $x        - "X axis of the signature | eixo x da assinatura"
         * param                    float $y        - "Y axis of the signature | eixo y da assinatura"
         * param                    int $z          - "Z is the page of signatura | Z é a página da assinatura"
         * param                    string $element - "Signature's type | Tipo de assinatura"
         * return                   void
         */
        public function addPositions(float $x, float $y, int $z, string $element) : void
        {
            if(!in_array($element, $this->availableElements))
                throw new \Exception('en-US: Element '. $element. ' are not recognized by the class! Verify the orthography | pt-BR: Elemento '. $element. ' não é reconhecido pela classe! Verifique a ortográfia!');

            array_push($this->positions, [
                'x' => number_format($x, 1, '.', ''),
                'y' => number_format($y, 1, '.', ''),
                'z' => (string) $z,
                'element' => $element
            ]);
        }

        /**
         * @description-en-US       Return positions
         * @description-pt-BR       Retorna posições
         * author                   Anderson Arruda < andmarruda@gmail.com >
         * version                  1.0.0
         * access                   public
         * param                    
         * return                   array
         */
        public function getPositions() : array
        {
            return $this->positions;
        }
    }
?>