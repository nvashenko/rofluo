<?php $count = count($rows); ?>
<?php foreach ($rows as $id => $row): ?>
  <?php if($id == $count -1): ?>
    <div class="news-item last">
  <?php else: ?>
    <div class="news-item">
  <?php endif; ?>
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
