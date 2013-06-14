<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Setting;
use AmCharts\Chart\Renderer\AbstractRenderer;
use AmCharts\Chart\Renderer\RendererInterface;
use AmCharts\Chart\Exception;
use AmCharts\Manager;
use AmCharts\Utils;

abstract class AbstractChart
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var integer|string
     */
    protected $width = '100%';

    /**
     * @var integer|string
     */
    protected $height = '400px';

    /**
     * @var Setting\Text
     */
    protected $text;

    /**
     * @var array
     */
    protected $colors = array();

    /**
     * @var array
     */
    protected $labels = array();

    /**
     * @var Legend
     */
    protected $legend;

    /**
     * @var Setting\Formatter\AbstractFormatter
     */
    protected $numberFormatter;

    /**
     * @var Setting\Formatter\AbstractFormatter
     */
    protected $percentFormatter;

    /**
     * @var DataProvider
     */
    protected $dataProvider;

    /**
     * @var AbstractRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param null|string $id
     * @param array $attribs
     */
    public function __construct($id = null, array $attribs = array())
    {
        if (null !== $id) {
            $this->setId($id);
        }
        
        foreach ($attribs as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        $this->init();
    }

    /**
     * Initialize chart
     */
    public function init()
    {

    }

    /**
     * Sets chart id
     *
     * @param string $id
     * @return AbstractChart
     */
    public function setId($id)
    {
        $this->id = (string) $id;

        return $this;
    }

    /**
     * Returns chart id
     *
     * @return string
     */
    public function getId()
    {
        if (!isset($this->id)) {
            $this->generateId();
        }

        return $this->id;
    }

    /**
     * Generate id
     */
    protected function generateId()
    {
        $id = 'chart_' . Utils::generateRandomKey();
        $this->setId($id);
    }

    /**
     * Returns chart type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets chart title
     *
     * @param string $title
     * @return AbstractChart
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;

        return $this;
    }

    /**
     * Returns chart title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets width
     *
     * @param string $width
     * @return AbstractChart
     */
    public function setWidth($width)
    {
        if (is_numeric($width)) {
            $width .= 'px';
        } elseif (!preg_match('/([\d].*)(px|\%)/', $width)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected integer or value suffixed by pixel or percent unit; Received %s.',
                $width
            ));
        }

        $this->width = (string) $width;

        return $this;
    }

    /**
     * Returns width
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets height
     *
     * @param string $height
     * @return AbstractChart
     */
    public function setHeight($height)
    {
        if (is_numeric($height)) {
            $height .= 'px';
        } elseif (!preg_match('/([\d].*)(px|\%)/', $height)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected integer or value suffixed by pixel or percent unit; Received %s.',
                $height
            ));
        }

        $this->height = (string) $height;

        return $this;
    }

    /**
     * Returns height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets and returns text object
     *
     * @param array $params
     * @return Setting\Text
     */
    public function text($params = array())
    {
        if (!isset($this->text)) {
            $this->text = new Setting\Text();
        }

        $this->text->setParams($params);

        return $this->text;
    }

    /**
     * Sets colors
     *
     * @param array $colors
     * @return AbstractChart
     */
    public function setColors(array $colors)
    {
        $this->colors = array();
        foreach ($colors as $color) {
            $this->addColor($color);
        }

        return $this;
    }

    /**
     * Add color
     *
     * @param string|array|Setting\Color $color
     * @return AbstractChart
     */
    public function addColor($color)
    {
        if ($color instanceof Setting\Color) {
            $this->colors[] = $color;
        } else {
            $this->colors[] = new Setting\Color($color);
        }

        return $this;
    }

    /**
     * Add label
     *
     * @param string|Setting\Label $label
     * @param array $params
     * @return AbstractChart
     */
    public function addLabel($label, $params = array())
    {
        if ($label instanceof Setting\Label) {
            $this->labels[] = $label;
        } else {
            $this->labels[] = new Setting\Label($label, $params);
        }

        return $this;
    }

    /**
     * Sets and returns legend
     *
     * @param array $params
     * @return Legend
     */
    public function legend($params = array())
    {
        if (!isset($this->legend)) {
            $this->legend = new Legend();
        }

        $this->legend->setParams($params);

        return $this->legend;
    }

    /**
     * Sets and returns number formatter
     *
     * @param array $params
     * @return Setting\Formatter\Number
     */
    public function numberFormatter($params = array())
    {
        if (!isset($this->numberFormatter)) {
            $this->numberFormatter = new Setting\Formatter\Number();
        }

        $this->numberFormatter->setParams($params);

        return $this->numberFormatter;
    }

    /**
     * Sets and returns percent formatter
     *
     * @param array $params
     * @return Setting\Formatter\Percent
     */
    public function percentFormatter($params = array())
    {
        if (!isset($this->percentFormatter)) {
            $this->percentFormatter = new Setting\Formatter\Percent();
        }

        $this->percentFormatter->setParams($params);

        return $this->percentFormatter;
    }

    /**
     * Sets data provider
     *
     * @param array|DataProvider $provider
     * @return AbstractChart
     */
    public function setDataProvider($provider)
    {
        if (is_array($provider)) {
            $provider = new DataProvider($provider);
        } elseif (!($provider instanceof DataProvider)) {
            throw new Exception\InvalidArgumentException(
                'Data provider must be an instance of %s\DataProvider class.',
                __NAMESPACE__
            );
        }

        $this->dataProvider = $provider;

        return $this;
    }

    /**
     * Returns data provider
     *
     * @return array
     */
    public function getDataProvider()
    {
        return $this->dataProvider;
    }

    /**
     * Returns params
     *
     * @return array
     */
    public function getParams()
    {
        $params = array();

        $manager = Manager::getInstance();

        $imagesPath = $manager->getImagesPath();
        if ($imagesPath) {
            $params['pathToImages'] = $imagesPath;
        }

        $dataProvider = $this->getDataProvider();
        if (null !== $dataProvider) {
            $data = $dataProvider->toArray();
            $params['dataProvider'] = json_encode(array_values($data));
        }

        return $params;
    }

    /**
     * Returns attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        $attribProperties = array(
            'legend', 'valueAxis', 'graphs', 'cursor', 'scrollbar',
            'numberFormatter', 'percentFormatter',
        );

        $attributes = array();
        foreach ($attribProperties as $property) {
            if (isset($this->{$property})) {
                $attributes[$property] = $this->{$property};
            }
        }

        return $attributes;
    }

    /**
     * Set renderer
     *
     * @param AbstractRenderer $renderer
     * @return AbstractChart
     */
    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->setChart($this);
        return $this;
    }

    /**
     * Returns renderer
     *
     * @return AbstractRenderer
     */
    public function getRenderer()
    {
        if (!isset($this->renderer)) {
            $this->setRenderer(new Renderer);
        }

        return $this->renderer;
    }

    /**
     * Returns the HTML code to insert on the page
     *
     * @return	string
     */
    public function render()
    {
        return $this->getRenderer()->render();
    }

    public function __clone()
    {
        $this->generateId();
    }
}