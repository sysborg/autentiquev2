<?php
    namespace sysborg\autentiquev2;

    final class autoloader{
        /**
         * @description-en-US:       Store path for autoload
         * @description-pt-BR:       Armazena caminhos para o autoload
         * @var                      array
         */
        private static array $loadPath = [
            'sysborg\autentiquev2\layouts'      => '/layouts.interface.php',
            'sysborg\autentiquev2\common'       => '/layouts/common.class.php',
            'sysborg\autentiquev2\listDir'      => '/layouts/dir/listDir.class.php',
            'sysborg\autentiquev2\createDir'    => '/layouts/dir/createDir.class.php',
            'sysborg\autentiquev2\deleteDir'    => '/layouts/dir/deleteDir.class.php',
            'sysborg\autentiquev2\createDoc'    => '/layouts/doc/createDoc.class.php',
            'sysborg\autentiquev2\utils'        => '/utils.traits.php',
            'sysborg\autentiquev2\autentique'   => '/autentique.class.php'
        ];

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
    }

    spl_autoload_register(function($cls){
        require_once __DIR__. \sysborg\autentiquev2\autoloader::getClassPath($cls);
    });
?>
