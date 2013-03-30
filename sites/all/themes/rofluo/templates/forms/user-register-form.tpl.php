<?php if(1){} ?>
<?php print render($form['field_fio']); ?>
<?php print render($form['account']['name']); ?>
<?php print render($form['account']['pass']['pass1']); ?>
<?php print render($form['account']['pass']['pass2']); ?>

<div class="wrap tooltip-wrap">
  <div class="t3 tooltip">
    <div class="register-lock-bg"></div>
    <?php print render($form['account']['mail']); ?>
    <?php print render($form['field_phone']); ?>
  </div>
</div>

<?php print drupal_render_children($form); ?>
