<div class="date"><?php print $date; ?></div>
<div class="news-content">
  <h4><?php print $node->title; ?></h4>
  <p><?php print $description; ?></p>
  <?php print l('читать<span></span>','node/' . $node->nid, array('html' => TRUE, 'attributes' => array('class' => array('read-link')))); ?>
</div>
