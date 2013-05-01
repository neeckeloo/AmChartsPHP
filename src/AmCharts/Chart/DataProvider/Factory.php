<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider;

use AmCharts\Chart\DataProvider;
use AmCharts\Chart\DataProvider\Reader\ReaderInterface;
use AmCharts\Chart\Exception;
use Zend\Http\Client as HttpClient;

class Factory
{
    const JSON = 'json';
    const XML  = 'xml';
    const CSV  = 'csv';

    /**
     * Plugin manager for loading readers
     *
     * @var null|ReaderPluginManager
     */
    public static $readers = null;

    /**
     * HTTP client
     *
     * @var null|HttpClient
     */
    public static $httpClient = null;
    
    /**
     * Registered data file extensions
     * 
     * @var array 
     */
    protected static $extensions = array(
        self::JSON => self::JSON,
        self::XML  => self::XML,
        self::CSV  => self::CSV,
    );
    
    /**
     * Read data from a file
     * 
     * @param string $filename
     * @return DataProvider
     */
    public static function fromFile($filename)
    {
        $pathinfo = pathinfo($filename);
        
        if (!isset($pathinfo['extension'])) {
            throw new Exception\RuntimeException(sprintf(
                'Filename "%s" is missing an extension and cannot be auto-detected',
                $filename
            ));
        }
        
        $extension = strtolower($pathinfo['extension']);
        
        if ($extension == 'php') {
            if (!is_file($filename) || !is_readable($filename)) {
                throw new Exception\RuntimeException(sprintf(
                    'File "%s" does not exists or not readable',
                    $filename
                ));
            }
            
            $data = include $filename;
        } elseif (isset(self::$extensions[$extension])) {
            $reader = self::$extensions[$extension];
            if (!($reader instanceof ReaderInterface)) {
                $reader = self::getReaderPluginManager()->get($reader);
                self::$extensions[$extension] = $reader;
            }
            
            $data = $reader->fromFile($filename);
        } else {
            throw new Exception\RuntimeException(sprintf(
                'Unsupported data file extension: .%s',
                $pathinfo[$extension]
            ));
        }
        
        return new DataProvider($data);
    }
    
    /**
     * Read data from an url
     *
     * @param string $url
     * @param null|string $format
     * @return DataProvider
     */
    public static function fromUrl($url, $format = null)
    {
        $client = self::getHttpClient();
        $client->setUri($url);

        $response = $client->send();
        $content = $response->getBody();

        if (null === $format) {
            $contentTypeHeader = $response->getHeaders()->get('content-type');
            $contentType = $contentTypeHeader->getFieldValue();
            $parts = explode('/', $contentType);
            $extension = $parts[1];
        } else {
            $extension = strtolower($format);
        }

        if (isset(self::$extensions[$extension])) {
            $reader = self::$extensions[$extension];
            if (!($reader instanceof ReaderInterface)) {
                $reader = self::getReaderPluginManager()->get($reader);
                self::$extensions[$extension] = $reader;
            }

            $data = $reader->fromString($content);
        } else {
            throw new Exception\RuntimeException(sprintf(
                'Unsupported data file format: %s',
                $extension
            ));
        }

        return new DataProvider($data);
    }

    /**
     * Set reader plugin manager
     *
     * @param ReaderPluginManager $readers
     */
    public static function setReaderPluginManager(ReaderPluginManager $readers)
    {
        self::$readers = $readers;
    }

    /**
     * Returns the reader plugin manager
     *
     * @return ReaderPluginManager
     */
    public static function getReaderPluginManager()
    {
        if (static::$readers === null) {
            static::$readers = new ReaderPluginManager();
        }

        return static::$readers;
    }

    /**
     * Sets HTTP client
     *
     * @param HttpClient $client
     */
    public static function setHttpClient(HttpClient $client)
    {
        self::$httpClient = $client;
    }

    /**
     * Returns HTTP client
     *
     * @return HttpClient
     */
    public static function getHttpClient()
    {
        if (static::$httpClient === null) {
            static::$httpClient = new HttpClient();
        }

        return static::$httpClient;
    }

    /**
     * Sets config reader for file extension
     *
     * @param  string $extension
     * @param  string|ReaderInterface $reader
     * @throws Exception\InvalidArgumentException
     */
    public static function registerReader($extension, $reader)
    {
        $extension = strtolower($extension);

        if (!is_string($reader) && !$reader instanceof ReaderInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Reader should be plugin name, class name or ' .
                'instance of %s\Reader\ReaderInterface; received "%s"',
                __NAMESPACE__,
                (is_object($reader) ? get_class($reader) : gettype($reader))
            ));
        }

        self::$extensions[$extension] = $reader;
    }
}