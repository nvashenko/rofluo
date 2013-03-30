<div class="item">
 <?php if(!empty($link)) : ?>
    <?php print l(render($image), $link['url'], array('html' => TRUE, 'attributes' => $link['attributes'])); ?>
 <?php else: ?>
  <?php print render($image); ?>
 <?php endif; ?>
</div>