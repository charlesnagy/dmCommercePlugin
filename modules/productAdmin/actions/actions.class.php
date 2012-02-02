<?php

require_once dirname(__FILE__).'/../lib/productAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/productAdminGeneratorHelper.class.php';

/**
 * productAdmin actions.
 *
 * @package    eds.diem.serard
 * @subpackage productAdmin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class productAdminActions extends autoProductAdminActions
{
    public function executeToggleArchive(dmWebRequest $request)
    {
        $value = 1 - $this->getUser()->getAttribute('show_archive', 0, 'DmCommerce');
        $this->getUser()->setAttribute('show_archive', $value, 'DmCommerce');
        
        $this->redirect($request->getReferer());
    }
    
    protected function getFilters()
    {
        $defaults = $this->configuration->getFilterDefaults();
        $filters = $this->getUser()->getAttribute('productAdmin.filters', array(), 'admin_module');
        return array_merge($filters, $defaults);
    }    
}
