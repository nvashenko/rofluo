<?php
$link = reset($links);
?>
<?php print theme('rate_button', array('text' => '<span>' . $results['count'] . '</span>', 'href' => $link['href'], 'class' => 'like-link')); ?>