<?php

class sfValidatorDmComCharacteristics extends sfValidatorBase
{
  protected function configure($options = array(), $messages = array())
  {
      $this->addOption('max_length', 255);
    $this->addMessage('max_length', '"%value%" is too long (%max_length% characters max).');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    if($value != 'on')
    {
        // Not a checkbox
        if(strlen($value) > $this->getOption('max_length'))
        {
            throw new sfValidatorError($this, 'max_length', array('value' => $value, 'max_length' => $this->getOption('max_length')));                
        }
    }

    return $value;
  }
}