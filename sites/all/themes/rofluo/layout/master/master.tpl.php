<div class='top_nav'><?php print $content['menu']; ?></div>
<div class='all'>
	<div class='head'>
    <div id="logo">
      <h3 class="incl"><a href="/" title="<?php print t(variable_get('site_name')); ?>"><?php print t(variable_get('site_name')); ?></a></h3>

    </div><!-- end #logo -->
    <?php print $content['header']; ?>
  </div>
	<div class='main'>
    <?php print $content['page_content']; ?>
	</div>
</div>