<?php foreach ($rows as $id => $row): ?>
  <div class="burge-item tooltip-wrap <?php if ($classes_array[$id]) { print $classes_array[$id];  } ?>">
    <?php print $row; ?>
  </div>
<?php endforeach; ?>
