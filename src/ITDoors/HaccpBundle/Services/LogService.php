<?php

namespace ITDoors\HaccpBundle\Services;
use Symfony\Component\DependencyInjection\Container;

/**
 * Log service
 */
class LogService
{
    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct()
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Write content to log file
     *
     * @param mixed $content
     */
    public function write($content)
    {
        $logFile = $this->container->getParameter('log.file.path');
        $f1 = fopen($logFile, "a");
        fwrite($f1, $content);
        $output = PHP_EOL;
        fwrite($f1, $output);
        fclose($f1);
    }
}
