<h3><?php print $node->title; ?></h3>
<p><?php print $description; ?></p>
<div class="more-btn-wrap">
  <?php print l('подробнее','node/' . $node->nid); ?>
</div>
<div class="flip more-btn-wrap">
  <a href="#"><?php print t('подробнее'); ?></a>
</div>
<div class="overlay"></div>