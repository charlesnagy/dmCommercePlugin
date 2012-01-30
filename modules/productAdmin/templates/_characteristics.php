<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]+/', '_', dmString::transliterate(strtolower($fieldset))) ?>">
    <h2 class="fieldset_title ui-accordion-header ui-helper-reset ui-state-default ui-corner-top">
      <span class="ui-icon ui-icon-triangle-1-e"></span>
      <span class="fieldset_name"><?php echo __('Characteristics') ?></span>
    </h2>
    <div class="fieldset_content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active">

    <?php if($product->isNew()): ?>
        <p class="help_box">
          <span class="s16 s16_help block"><?php echo __('Save this product to access the characteristics.') ?></span>
        </p>
    <?php else: ?>
    <?php foreach($form->getSpecs() as $group=>$specs): ?>
        <table class="subsection">
            <tr>
                <th class="rotate"><div><?php echo $group ?></div></th>
            <tr>
            </tr>
                <td>
                    <?php $i = 0; $class = array('odd', 'even') ?>
                <?php foreach($specs as $spec): ?>
                    <div class="<?php echo $class[$i]; $i = 1 - 0; ?> sf_admin_form_row_inner clearfix property <?php $form[$spec]->hasError() and print ' errors' ?>">
                        <?php if ($form[$spec]->hasError()): ?>
                          <div class="error">
                            <div class="s16 s16_error"><?php echo __((string) $form[$spec]->getError()) ?></div>
                          </div>
                        <?php endif; ?>
                        <div class="label_wrap">
                            <?php echo $form[$spec]->renderLabel() ?>
                        </div>
                        <div class="content">
                            <?php echo $form[$spec]->render() ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </td>
            </tr>
        </table>        
    <?php endforeach; ?>
    <?php endif; ?>

  </div>

</fieldset>
