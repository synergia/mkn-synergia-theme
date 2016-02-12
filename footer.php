<?php global $general_options; ?>
    </div>
</div><!--Closes Global -->
<div class="footer-wrapper">
  <div class="footer">
      <a href="http://www.pwr.edu.pl/index.dhtml" target="_blank">
          <?php get_template_part('template-part', 'pwr'); ?>
      </a>
      <span class="footer__social">
          <a class="link link--glowing" href="<?php echo site_url(); ?>/archive" title="Archiwum"><i class="icon-archive"></i></a>
          <a class="link link--glowing" href="<?php echo $general_options['fb_link'] ?>" title="Polub"><i class="icon-facebook"></i></a>
          <a class="link link--glowing" href="<?php echo $general_options['twitter_link'] ?>" title="Śledź"><i class="icon-twitter"></i></a>
          <a class="link link--glowing" href="<?php echo $general_options['github_link'] ?>" title="Kod"><i class="icon-github"></i></a>
      </span>
      <span class="footer__others">
          <a class="link link--footer" href="http://wmech.pwr.wroc.pl/">Wydział Mechaniczny</a> &middot;
          <a class="link link--footer" href="http://tmm.pwr.wroc.pl">Zakład Teorii Maszyn i Układów Mechatronicznych</a> &middot;
          <a class="link link--footer" href="http://weka.pwr.wroc.pl/">Wydział Elektroniki</a>
      </span>
      <span class="footer__mknm">
          <a class="link link--footer" href="<?php echo esc_url(home_url('/')); ?>">Międzywydziałowe Koło Naukowe Mechatroniki "Synergia"</a> <?php echo comicpress_copyright(); ?>
      </span>
      </div>



    </div>
  </div>
</div>
<!-- end main container -->
<?php echo $general_options['g_anal']; ?>
<?php wp_footer(); ?>
</body>
</html>
