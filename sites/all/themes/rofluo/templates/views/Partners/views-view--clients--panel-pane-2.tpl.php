<div class="c22">
  <div class="partners-block ">
    <?php print render($title_prefix); ?>
    <h3><?php print t('Наши партнеры'); ?></h3>
    <?php print render($title_suffix); ?>
    <?php if ($header): ?>
      <div class="view-header">
        <?php print $header; ?>
      </div>
    <?php endif; ?>

    <?php if ($exposed): ?>
      <div class="view-filters">
        <?php print $exposed; ?>
      </div>
    <?php endif; ?>

    <?php if ($attachment_before): ?>
      <div class="attachment attachment-before">
        <?php print $attachment_before; ?>
      </div>
    <?php endif; ?>

    <?php if ($rows): ?>
        <?php print $rows; ?>
    <?php elseif ($empty): ?>
      <div class="view-empty">
        <?php print $empty; ?>
      </div>
    <?php endif; ?>

    <?php if ($pager): ?>
      <?php print $pager; ?>
    <?php endif; ?>

    <?php if ($attachment_after): ?>
      <div class="attachment attachment-after">
        <?php print $attachment_after; ?>
      </div>
    <?php endif; ?>

    <?php if ($more): ?>
      <?php print $more; ?>
    <?php endif; ?>

    <?php if ($footer): ?>
      <div class="view-footer">
        <?php print $footer; ?>
      </div>
    <?php endif; ?>

    <?php if ($feed_icon): ?>
      <div class="feed-icon">
        <?php print $feed_icon; ?>
      </div>
    <?php endif; ?>
    </div>
  </div>
</div>