<?php global $general_options; ?>
<div class="dmbs-footer">
    <div class=" gl">
      <div class="mknm-footer gl-sm-5 gl-cell">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Międzywydziałowe Koło Naukowe<br>Mechatroniki "Synergia"</a> <?php echo comicpress_copyright(); ?>
        <ul>
          <li><a href="http://tmm.pwr.wroc.pl">Zakład Teorii Maszyn i Układów Mechatronicznych</a></li>
          <li><a href="http://wmech.pwr.wroc.pl/">Wydział Mechaniczny</a></li>
          <li><a href="http://weka.pwr.wroc.pl/">Wydział Elektroniki</a></li>
        </ul>
      </div>
      <div class="gl-sm-2 gl-cell">
        <a href="http://www.pwr.edu.pl/index.dhtml" target="_blank">
          <div class="pwr"></div>
        </a>
      </div>
      <div class="gl-sm-5 gl-cell footer-icons">
        <div>
          <a href="<?php echo $general_options['archive_link'] ?>" title="Archiwum"><i class="icon-archive"></i></a>
          <a href="<?php echo $general_options['fb_link'] ?>" title="Polub"><i class="icon-facebook"></i></a>
          <a href="<?php echo $general_options['twitter_link'] ?>" title="Śledź"><i class="icon-twitter"></i></a>
          <a href="<?php echo $general_options['github_link'] ?>" title="Kod"><i class="icon-github"></i></a>
        </div>
      </div>
    </div>
</div>
<!-- end main container -->
<?php echo $general_options['g_anal']; ?>
<?php wp_footer(); ?>
</body>
</html>
