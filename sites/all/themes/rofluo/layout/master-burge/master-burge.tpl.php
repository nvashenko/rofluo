<div id="wrap">
  <div id="header">
    <div class="container">
      <div id="logo">
        <h3 class="incl"><a href="/" title="<?php print t(variable_get('site_name')); ?>"><?php print t(variable_get('site_name')); ?></a></h3>
      </div><!-- end #logo -->
      <div id="slogan">
        <p><?php print t('Биржа<br>интелектуальной собственности<br> и авторского права'); ?></p>
      </div><!-- end #slogan -->
      <div id="socialcontact">
        <?php print $content['header']; ?>
      </div><!-- end #socialcontact -->
      <div class="cl"></div>
    </div><!-- end .container -->
  </div><!-- end #header -->
  <div id="menu">
     <div class="container">
       <div class="menu-left"></div>
       <?php print $content['menu']; ?>
       <div class="menu-right"></div>
     </div><!-- end .container -->
   </div><!-- end #menu -->
  <div id="preface-top">
    <div class="container">
      <?php print $content['preface_top']; ?>
    </div>
  </div>
  <div id="burge">
    <div class="burge-bg">
      <div class="container">
        <div class="cf">
          <?php print $content['slideshow']; ?>
        </div>
      </div>
    </div>
  </div>

  <?php print $content['page_content']; ?>
  <div id="footer">
    <div class="container">
      <div class="footer tooltip-wrap">
        <div class="t3 tooltip">
          <div class="c2">
            <div class="c21">
              <?php print $content['footer_left']; ?>
            </div>
            <div class="c22">
              <div class="footer-logo">
                <h3><?php print t(variable_get('site_name')); ?></h3>
                <h4><?php print t('Биржа интелектуальной собственности'); ?></h4>
              </div>
              <?php print $content['footer_right']; ?>
            </div>
          </div>
        </div>
      </div>
    </div><!-- end .container -->
  </div><!-- end #footer -->
</div><!-- end #wrap -->
