<?php global $dm_settings; ?>
<div class="dmbs-footer row">
                    <div class="mkn-footer col-sm-5">
                        <div class="mkn-footer-inner">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Międzywydziałowe Koło Naukowe<br>Mechatroniki "Synergia"</a> <?php echo comicpress_copyright(); ?>
                            <ul>
                                <li><a href="http://tmm.pwr.wroc.pl">Zakład Teorii Maszyn i Układów Mechatronicznych</a></li>
                                <li><a href="http://wmech.pwr.wroc.pl/">Wydział Mechaniczny</a></li>
                                <li><a href="http://weka.pwr.wroc.pl/">Wydział Elektroniki</a></li>
                            </ul>
                            <?php get_template_part('template-part', 'footernav'); ?>

                        </div>
                    </div>
                    <a href="http://pwr.wroc.pl" target="_blank"><div class="col-sm-2 pwr"><img src="<?php echo get_template_directory_uri(); ?>/img/pwr.png"/>
                </div></a>
                                                            <div class="col-sm-5 footer-right">
                                            <div class="center">
                        <a href="<?php echo $dm_settings['archiwum'] ?>" title="Archiwum"><i class="icon-archive"></i></a>
                        <a href="http://facebook.com/mknmsynergia" title="Polub"><i class="icon-facebook"></i></a>
                        <a href="http://github.com/synergia" title="Kod"><i class="icon-github"></i></a>
                                            </div>
                    </div>
</div>
<!-- end main container -->

<?php wp_footer(); ?>
</body>
</html>
