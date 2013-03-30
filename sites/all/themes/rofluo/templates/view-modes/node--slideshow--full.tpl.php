<div class="carousel-feature" >
  <?php print render($image); ?>
  <span class="slide-border"></span>
    <div class="<?php print $caption_classes; ?>">
      <?php if($btn && !empty($link)): ?>
        <div class="tm-btn-wrap">
          <?php print l($node->title, $link['url'], array('attributes' => $link['attributes'])); ?>
        </div>
      <?php elseif(!empty($link)): ?>
        <p><?php print l($node->title, $link['url'], array('attributes' => $link['attributes'])); ?></p>
      <?php else: ?>
        <p><?php print $node->title; ?></p>
      <?php endif; ?>
    </div>
  <div class="shadow"></div>
</div>
