<div class="main-content">
  <h1 class="title">
    <?php if(!empty($content['field_news_date'])) : ?>
      <?php print render($content['field_news_date']); ?>
    <?php endif; ?>
    <?php print $node->title; ?></h1>
  <div class="thumbnail left">
    <?php if(!empty($content['field_news_image'])) : ?>
      <?php print render($content['field_news_image']); ?>
    <?php endif; ?>
  </div>
  <div class="description">
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  <div class="comments">
    <?php if(!empty($content['comments'])) : ?>
      <?php print render($content['comments']); ?>
    <?php endif; ?>
  </div>
</div>