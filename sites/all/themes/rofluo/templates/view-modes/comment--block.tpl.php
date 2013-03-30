<div class="t3 tooltip">
  <p>
    <span class="quote-name"><?php print $username; ?></span>
    |
    <span class="quote-date"><?php print $date; ?></span>
  </p>
  <?php print $description; ?>
  <?php print l('читать<span></span>', 'comment/' . $comment->cid, array('fragment' => 'comment-' . $comment->cid, 'html' => TRUE, 'attributes' => array('class' => array('read-link')))); ?>
</div>