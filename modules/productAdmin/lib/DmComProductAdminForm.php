<?php

/**
 * productAdmin admin form
 *
 * @package    eds.diem.serard
 * @subpackage productAdmin
 * @author     Your name here
 */
class DmComProductAdminForm extends BaseDmComProductForm
{
    protected $specs = null;
    
  public function configure()
  {
    parent::configure();
    
    $this->setWidget('status', new sfWidgetFormChoice(array('choices'=>array(0=>'Active', 1=>'Inactive', 2=>'Archive'), 'expanded'=>true)));
    $this->setValidator('status', new sfValidatorChoice(array('choices'=>array(0, 1, 2))));
    
    $this->setValidator('vat', new sfValidatorInteger(array('min'=>0, 'max'=>100, 'required'=>true)));
    
    $this->setWidget('description', new sfWidgetFormTextareaDmCkEditor());
    
    if(!$this->getObject()->isNew())
    {
        $specs = array();
        $characteristics = $this->getObject()->getCharacteristics();
        $current = false;
        foreach($characteristics as $c)
        {
            $group = $c->getProductCharType();
            $specs[$group->getName()][] = 'chr_'.$c->getId();
            $this->setWidget('chr_'.$c->getId(), $c->getWidget());
            $this->widgetSchema['chr_'.$c->getId()]->setLabel($c->getName());
            $this->setValidator('chr_'.$c->getId(), new sfValidatorDmComCharacteristics(array('required'=>false)));
        }
        
        $properties = $this->getObject()->getProperties();
        if($properties)
        {
            foreach($properties as $v)
            {
                $this->setDefault('chr_'.$v->getProperty()->getId(), $v->getValue());
            }
        }
        
        $this->specs = $specs;
    }
  }
  
  public function save($con = null) {
    $product = parent::save($con);

    $updated = array();
    $properties = $this->getObject()->getProperties();
    if($properties)
    {
        foreach($properties as $v)
        {
            $taintedValue = $this->getValue('chr_'.$v->getProperty()->getId());
            if(!empty($taintedValue))
            {
                if($taintedValue != $v->getValue())
                {
                    $v->setValue($taintedValue);
                    $v->save();
                }
            }
            else
            {
                $v->setValue(null);
                $v->save();
            }
            $updated['chr_'.$v->getProperty()->getId()] = true;
        }
    }
    foreach($this->getValues() as $key=>$value)
    {
        if(!empty($value) && !array_key_exists($key, $updated) && preg_match('#^chr_([0-9]*)$#', $key, $matches))
        {
            $propertyValue = new DmComProductCharTypePropertyProduct();
            $propertyValue->setProduct($product);
            $propertyValue->setDmComProductCharTypeProperyId($matches[1]);
            $propertyValue->setValue($value);
            $propertyValue->save();
        }
    }
    $product->clearCache('properties');

    return $product;
  }
  
  public function getStylesheets()
  {
    return array_merge(parent::getStylesheets(), array(
      'dmCommercePlugin.form' => 'all'
    ));
  }
  
  public function getSpecs()
  {
      return $this->specs;
  }
}