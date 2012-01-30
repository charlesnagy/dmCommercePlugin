<?php

/**
 * productCharacteristicTypePropertyAdmin admin form
 *
 * @package    eds.diem.serard
 * @subpackage productCharacteristicTypePropertyAdmin
 * @author     Your name here
 */
class DmComProductCharTypePropertyAdminForm extends BaseDmComProductCharTypePropertyForm
{
  public function configure()
  {
    parent::configure();
    $this->setWidget('type', new sfWidgetFormChoice(array('choices'=>  DmComProductCharTypePropertyTable::getInstance()->getTypes())));

    $this->setValidator('type', new sfValidatorInteger());
    
  }
}