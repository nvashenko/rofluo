<div class="main-content">
  <?php if(!empty($title)): ?>
    <h1><?php print $title; ?></h1>
  <?php endif; ?>
  <div class="about-exchange-wrap" >
    <?php print render($content); ?>
  </div>
</div>