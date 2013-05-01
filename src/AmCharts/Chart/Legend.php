<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Setting\Border;
use AmCharts\Chart\Setting\Margin;
use AmCharts\Chart\Setting\Text;
use AmCharts\Chart\Exception;

class Legend
{
    /**
     * @var Margin
     */
    protected $margin;

    /**
     * @var Border
     */
    protected $border;
    
    /**
     * @var Text 
     */
    protected $text;

    /**
     * The text which will be displayed in the legend
     *
     * (default value: [[title]])
     *
     * @var string
     */
    protected $labelText;

    /**
     * The text which will be displayed in the value portion of the legend
     * 
     * (default value: [[value]])
     *
     * @var string
     */
    protected $valueText;

    /**
     * @var boolean
     */
    protected $valueTextEnabled = true;
    
    /**
     * Constructor
     * 
     * @param array $params 
     */
    public function __construct($params = array())
    {
        $this->setParams($params);
    }
    
    /**
     * Sets parameters
     * 
     * @param array $params
     * @return Legend
     */
    public function setParams(array $params = array())
    {
        foreach ($params as $name => $value) {
            $method = 'set' . ucfirst($name);
            if (!method_exists($this, $method)) {
                continue;
            }
            
            call_user_func_array(array($this, $method), array($value));
        }
        
        return $this;
    }

    /**
     * Sets and returns border
     *
     * @param null|array $border
     * @return Border
     */
    public function border($border = null)
    {
        if (!isset($this->border)) {
            $this->border = new Border();
        }

        if (null !== $border) {
            $this->border->setParams($border);
        }

        return $this->border;
    }

    /**
     * Sets and returns margins
     *
     * @param null|array $margin
     * @return Margin
     */
    public function margin($margin = null)
    {
        if (!isset($this->margin)) {
            $this->margin = new Margin();
        }

        if (null !== $margin) {
            $this->margin->setValues($margin);
        }

        return $this->margin;
    }
        
    /**
     * Sets and returns text object
     *
     * @param array $params
     * @return Text
     */
    public function text($params = array())
    {        
        if (!isset($this->text)) {
            $this->text = new Text();
        }
        
        $this->text->setParams($params);

        return $this->text;
    }

    /**
     * Sets label text
     *
     * @param string $text
     * @return Legend
     */
    public function setLabelText($text)
    {
        if (!preg_match('/\[\[title\]\]/', $text)) {
            throw new Exception\InvalidArgumentException(
                'Label text must contains tag [[title]].'
            );
        }

        $this->labelText = (string) $text;

        return $this;
    }

    /**
     * Returns label text
     *
     * @return string
     */
    public function getLabelText()
    {
        return $this->labelText;
    }

    /**
     * Sets value text
     *
     * @param string $text
     * @return Legend
     */
    public function setValueText($text)
    {
        if (!preg_match('/\[\[(value|open|high|low|close|percents|description)\]\]/', $text)) {
            throw new Exception\InvalidArgumentException(
                'Value text must contains tags like'
                . ' [[value]], [[open]], [[high]], [[low]], [[close]], [[percents]], [[description]].'
            );
        }
        
        $this->valueText = (string) $text;

        return $this;
    }

    /**
     * Returns value text
     *
     * @return string
     */
    public function getValueText()
    {
        return $this->valueText;
    }

    /**
     * Sets true if value text is enabled
     *
     * @param boolean $enabled
     * @return Legend
     */
    public function setValueTextEnabled($enabled = true)
    {
        $this->valueTextEnabled = (bool) $enabled;

        return $this;
    }

    /**
     * Returns true if value text is enabled
     *
     * @return boolean
     */
    public function getValueTextEnabled()
    {
        return $this->valueTextEnabled;
    }
    
    /**
     * Returns legend as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $params = array();

        $forbidden = array('valueTextEnabled');

        $fields = array_keys(get_object_vars($this));
        foreach ($fields as $field) {
            if (!isset($this->{$field}) || in_array($field, $forbidden)) {
                continue;
            }

            if ($field == 'border' || $field == 'margin' || $field == 'text') {
                $params += $this->{$field}->toArray();
            } else {
                $params[$field] = $this->{$field};
            }
        }

        if (!$this->getValueTextEnabled()) {
            $params['valueText'] = '';
        }
        
        return $params;
    }
}