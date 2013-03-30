<div class="main-content">
  <h1 class="title"><?php print $node->title; ?></h1>
  <div class="thumbnail left"></div>
  <div class="description">
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  <div class="comments"></div>
</div>