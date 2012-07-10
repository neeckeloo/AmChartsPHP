<?php
/**
 * @category   AmCharts
 */

/**
 * @namespace
 */
namespace AmCharts\Exception;

/**
 * @uses       AmCharts\Exception
 * @uses       \UnexpectedValueException
 * @category   AmCharts
 */
class UnexpectedValueException 
    extends \UnexpectedValueException
    implements \AmCharts\Exception
{}