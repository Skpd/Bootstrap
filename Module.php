<?php

namespace Skpd\Bootstrap;

use Zend\Config\Config;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getConfig()
    {
        $config = new Config(array());

        if (is_dir(__DIR__ . '/config')) {
            $iterator  = new \RegexIterator(new \DirectoryIterator(__DIR__ . '/config'), '#\.config\.php$#i');
            foreach ($iterator as $file) {
                /** @var $file \DirectoryIterator */
                if ($file->isReadable()) {
                    $subConf = new Config(include $file->getRealPath());
                    $config->merge($subConf);
                }
            }
        }

        return $config;
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/Bootstrap',
                ),
            ),
        );
    }
}