<?php

/**
 * productAdmin module configuration.
 *
 * @package    eds.diem.serard
 * @subpackage productAdmin
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class productAdminGeneratorConfiguration extends BaseProductAdminGeneratorConfiguration
{
    public function getFilterDefaults()
    {
        return array('status' => array(1,2));
    }
}
