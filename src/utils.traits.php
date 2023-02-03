<?php
    namespace sysborg\autentiquev2;

    trait utils{
        /**
         * @description-en-US       Verify if column exists inside an array
         * @description-pt-BR       Verifica se uma coluna existe em uma array
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   array $arr
         * @param                   string  $columnName
         * @return                  void
         */
        public function verifyColumn(array $arr, string $columnName) : void
        {
            $keys = array_keys($arr);
            if(array_search($columnName, $keys)===-1)
                throw new \Exception('en-US: No variable '. $columnName. ' has been founded! Verify the name and try again! | pt-BR: Nenhuma variável com o nome '. $columnName. ' foi encontrada! Verifique o nome e tente novamente!');
        }

        /**
         * @description-en-US       Verify if the variable is not null and not ''
         * @description-pt-BR       Verifica se a variável não está nula e não é ''
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $variableName
         * @param                   mixed $val
         * @return                  void
         */
        public function verifyFill(string $variableName, $val) : void
        {
            if(is_null($val) || $val=='')
                throw new \Exception('en-US: Variable '. $variableName. ' can\'t be null or empty, please set a valid value! | pt-BR: A variável '. $variableName. ' não pode ser nula ou vazia, por favor preencha a variável com um valor válido!');
        }

        /**
         * @description-en-US       Verify email with regex
         * @description-pt-BR       Verifica email com regex
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.1
         * @changes                 Correcting the regular expression for email, suggested by @FalaiTio from issue#2
         * @access                  public
         * @param                   string $variableName
         * @param                   string $email
         * @return                  void
         */
        public function verifyEmail(string $variableName, string $email) : void
        {
            $exp = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
            if(!preg_match($exp, $email))
                throw new \Exception('en-US: Variable '. $variableName. ' must be a valid email, please verify the entry and try again! | pt-BR: A variável '. $variableName. ' deve ser um email válido, por favor verifique a entrada e tente novamente!');
        }

        /**
         * @description-en-US       Verify if is a valid file and if the path is valid too
         * @description-pt-BR       Verifica se é um arquivo válido e se o caminho é um caminho válido também
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $variableName
         * @param                   string $path
         * @return                  void
         */
        public function verifyFile(string $variableName, string $path) : void
        {
            if(!file_exists($path))
                throw new \Exception('en-US: Variable '. $variableName. ' must have a valid path for some file, please verify your file path and try again! | pt-BR: A variável '. $variableName. ' deve conter um caminho válido para um arquivo, por favor verifique o caminho do seu arquivo e tente novamente!');
        }

        /**
         * @description-en-US       Verify if has some signers or some dimensions at the array
         * @description-pt-BR       Verifica se existe algum assinante ou alguma dimensão na array
         * @author                  Anderson Arruda < andmarruda@gmail.com >
         * @version                 1.0.0
         * @access                  public
         * @param                   string $variableName
         * @param                   array $arr
         * @return                  void
         */
        public function verifyArray(string $variableName, array $arr) : void
        {
            if(count($arr) === 0)
                throw new \Exception('en-US: Variable '. $variableName. ' must have at least one signers setted! | pt-BR: A variável '. $variableName. ' deve conter pelo menos um assinante setado!');
        }
    }
?>
