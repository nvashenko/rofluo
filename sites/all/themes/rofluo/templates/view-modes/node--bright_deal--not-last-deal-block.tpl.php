<?php if(1){} ?>
<div class="t3 tooltip">
  <p>
    <span class="quote-date"><?php print $date; ?></span>
    <br>
    <?php print t('Юрист:'); ?>
    <span class="quote-name"><?php print $jurist; ?></span>
    <br>
    <?php print t('Компания:'); ?>
    <span class="quote-name"><?php print $company; ?></span>
  </p>
  <?php print $description; ?>
  <div class="links">
    <?php print $vote; ?>
    <?php print l('Узнать подробности<span></span>', 'node/' . $node->nid, array('html' => TRUE, 'attributes' => array('class' => array('read-link')))); ?>
  </div>
</div>