<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider;

use AmCharts\Chart\DataProvider;
use AmCharts\Chart\Exception;

class Factory
{
    /**
     * Plugin manager for loading readers.
     * 
     * @var null|ReaderPluginManager 
     */
    public static $readers = null;
    
    /**
     * Registered data file extensions.
     * 
     * @var array 
     */
    protected static $extensions = array(
        'json' => 'json',
        'xml'  => 'xml',
        'csv'  => 'csv',
    );
    
    /**
     * Read data from a file.
     * 
     * @param string $filename
     * @return array|DataProvider
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
        } else if (isset(self::$extensions[$extension])) {
            $reader = self::$extensions[$extension];
            if (!($reader instanceof Reader\ReaderInterface)) {
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
     * Set reader plugin manager
     *
     * @param ReaderPluginManager $readers
     */
    public static function setReaderPluginManager(ReaderPluginManager $readers)
    {
        self::$readers = $readers;
    }

    /**
     * Get the reader plugin manager
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
     * Sets config reader for file extension
     *
     * @param  string $extension
     * @param  string|Reader\ReaderInterface $reader
     * @throws Exception\InvalidArgumentException
     */
    public static function registerReader($extension, $reader)
    {
        $extension = strtolower($extension);

        if (!is_string($reader) && !$reader instanceof Reader\ReaderInterface) {
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