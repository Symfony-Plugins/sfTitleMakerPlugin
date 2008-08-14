<?php

/**
 * Base TSM HTML Title Class
 *
 * Provides an easy to use way of managing HTML hierachical title 
 * segments separated by a delimiter, such as:
 * 
 *     My Website » My module  » My Action 
 *
 * @package         sfTitleMakerPlugin
 * @author          Tom Haskins-Vaughan <tom@templestreetmedia.com> 
 */
class BasesfTitleMaker
{
  protected $titleArray   = array();
  protected $stem         = '';
  protected $includeStem  = true;
  protected $separator    = ' » ';
  protected $direction    = 'forward';

  public function __construct($string = null, $paramSeparator = null, $paramDirection = null)
  {
    $string ? $this->add($string) : 0;

    $this->separator = sfConfig::get('app_sfTitleMaker_html_title_separator', $this->separator);
    $this->direction = sfConfig::get('app_sfTitleMaker_html_title_direction', $this->direction);
    $this->stem      = sfConfig::get('app_sfTitleMaker_html_title_stem', '');

    $this->separator = $paramSeparator ? $paramSeparator : $this->separator;
    
    $paramDirection ? $this->setDirection($paramDirection) : null;
  }

  public function __toString()
  {
    return $this->getString();
  }

  public function setSeparator($v)
  {
    $this->separator = $v;
  }

  public function setDirection($v)
  {
    $this->direction = $v == 'forward' ? $v : 'backward';
  }

  public function includeStem($v)
  {
    $this->includeStem = $v ? true : false;
  }
  
  public function add($v)
  {
    $v ? $this->titleArray[] = $v : null;
  }
  
  public function removeLast()
  {
    array_pop($this->titleArray);
  }
  
  public function clear()
  {
    $this->titleArray = array();
  }
  
  protected function getArray()
  {
    if ($this->includeStem AND $this->stem)
    {
      array_unshift($this->titleArray, $this->stem);
    }

    return $this->titleArray;
  }
  
  public function getString()
  {
    $array = $this->getArray();
    $array = $this->direction == 'backward' ? array_reverse($array) : $array;

    $string = '';    
    for ($i=0; $i<count($array); $i++)
    {
      $string .= $i ? $this->separator : '';
      $string .= $array[$i];
    }
    return $string;
  }
}

?>
