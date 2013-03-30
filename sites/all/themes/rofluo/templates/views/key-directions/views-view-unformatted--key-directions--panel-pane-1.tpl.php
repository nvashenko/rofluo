<div class="c5 cf">
<?php foreach ($rows as $id => $row): ?>
  <div class="direction c5<?php print ($id+1); ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
</div>