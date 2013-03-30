<?php if(!empty($comment->depth) && $comment->depth > 0): ?>
  <div class="comment logged">
    <div class="reply-to"></div>
<?php else: ?>
  <div class="comment tooltip">
<?php endif; ?>
  <div class="info">
    <span class="name"><?php print $comment->name; ?></span> | <span class="date"><?php print format_date($comment->created, 'normal'); ?></span>
  </div>
  <div class="comment-text">
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['links']);
      print render($content);
    ?>
  </div>
  <?php print render($content['links']) ?>
  <div class="cleaefix cf"></div>
</div>
