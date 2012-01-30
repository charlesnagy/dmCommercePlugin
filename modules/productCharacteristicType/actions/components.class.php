<?php
/**
 * Product Characteristic Type components
 * 
 * No redirection nor database manipulation ( insert, update, delete ) here
 */
class productCharacteristicTypeComponents extends myFrontModuleComponents
{

  public function executeShow()
  {
    $query = $this->getShowQuery();
    
    $this->productCharacteristicType = $this->getRecord($query);
  }


}
