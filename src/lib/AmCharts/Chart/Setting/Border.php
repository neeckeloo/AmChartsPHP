<?php
/**
 * @category   AmCharts
 */
namespace AmCharts\Chart\Setting;

use AmCharts\Exception;

/**
 * @category   AmCharts
 */
class Border
{    
    /**
     * @var Color 
     */
    protected $color;
    
    /**
     * @var Alpha 
     */
    protected $alpha;
    
    /**
     * Constructor
     * 
     * @param string|array|Color $color
     * @param integer $alpha 
     */
    public function __construct($color, $alpha = 100)
    {
        $this->color($color);
        $this->setAlpha($alpha);
    }
    
    /**
     * Sets alpha
     * 
     * @param integer $alpha 
     * @return Border
     */
    public function setAlpha($alpha)
    {
        $this->alpha = new Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns alpha
     * 
     * @return integer 
     */
    public function getAlpha()
    {
        return $this->alpha->getOpacity();
    }
        
    /**
     * Sets and returns border color
     *
     * @param string|array|Color $color
     * @return Border
     */
    public function color($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Color) {
                $this->color = $color;
            } else {
                $this->color = new Color($color);
            }
        }

        return $this->color;
    }
    
    /**
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array(
            'borderColor' => $this->color->toString(),
        );
        
        if (isset($this->alpha)) {
            $options['borderAlpha'] = $this->alpha->getValue();
        }
        
        return $options;
    }
}