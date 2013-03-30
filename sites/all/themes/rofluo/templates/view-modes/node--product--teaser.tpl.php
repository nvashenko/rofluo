<div class=" tooltip">
  <div class="category">
    <?php print l($parent_category->name,'burge/' . $parent_category->tid); ?>
    &gt;
    <?php print l($category->name,'burge/' . $category->tid); ?>
  </div>
  <div class="burge-info">
    <?php if(!empty($image)): ?>
      <div class="thumbnail">
        <?php print $image; ?>
      </div>
    <?php endif; ?>
    <div class="info">
      <h3><?php print $node->title; ?></h3>
      <span class="date"><?php print $date; ?></span>
      <span class="author"><?php print $author; ?></span>
      <?php if(!empty($description)): ?>
        <div class="description">
          <span></span>
          <?php print $description; ?>
        </div>
      <?php endif; ?>
      <div class="stats">
        <span class="views"><?php print t('Просмотров: !views', array('!views' => (!empty($stats['totalcount'])) ? $stats['totalcount'] : 0)); ?></span>
        <span class="comments"><?php print t('Комментариев: !comment', array('!comment' => $node->comment_count)); ?></span>
        <?php print l('Оставить комментарий','comment/reply/' . $node->nid, array('attributes' => array('class' => array('comment')))); ?>
      </div>
    </div>
    <div class="actions">
      <div class="price"><?php print $price; ?></div>
      <div class="btn-wrapper">
        <a class="buy" href="#">Купить</a>
      </div>
    </div>
  </div>
  <div class="cl"></div>
</div>