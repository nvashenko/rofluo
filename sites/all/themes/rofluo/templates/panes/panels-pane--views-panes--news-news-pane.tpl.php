<div class="news">
  <div class="news-title">
    <?php if($pane->configuration['override_title']): ?>
      <h3><?php print $pane->configuration['override_title_text']; ?></h3>
      <?php print l('Подписатся', 'rss.xml', array('attributes' => array('class' => array('rss')))); ?>
    <?php endif; ?>
  </div>
  <?php print render($content); ?>
</div>