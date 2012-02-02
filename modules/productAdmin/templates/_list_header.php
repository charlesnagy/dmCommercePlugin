<?php 
/**
 * @author Nagy Károly ( http://charlesnagy.info )
 */
?>

<?php echo _link('productAdmin/toggleArchive')->text(__('Show archives'))->set('.toggle_link.'.($sf_user->getAttribute('show_archive', 0, 'DmCommerce') ? 'off' : 'on')); ?>