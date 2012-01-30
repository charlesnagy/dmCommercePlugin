<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">

  <div class="dm_active_locks"></div>

  <?php $formActions = get_partial('productAdmin/form_action_bar'.(sfConfig::get('dm_admin_embedded') ? '_embedded' : ''), array('dm_com_product' => $dm_com_product, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'nearRecords' => $nearRecords)); ?>

  <?php echo $form->renderFormTag(url_for(
    $form->getObject()->isNew()
    ? $helper->getRouteArrayForAction('create')
    : $helper->getRouteArrayForAction('update', $form->getObject())
  )); ?>

  <div class="dm_form_action_bar dm_form_action_bar_top clearfix">
    <?php echo $formActions; ?>
  </div>

    <div class="sf_admin_form_inner ui-widget ui-accordion">

    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <div class="fright w50">
    <?php echo include_partial('characteristics', array('form'=>$form, 'dm_com_product' => $dm_com_product, 'product'=>$form->getObject())) ?>
    </div>
    <div class="">
    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('productAdmin/form_fieldset', array('dm_com_product' => $dm_com_product, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>
    </div>

    </div>

  <div class="dm_form_action_bar dm_form_action_bar_bottom clearfix">
    <?php echo $formActions; ?>
  </div>

  </form>

  <div class="dm_active_locks"></div>

</div>