<?php
/*
Template Name: Członkowie
*/
?>

<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="row dmbs-content">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>
    <div class="col-sm-<?php synergia_main_content_width(); ?> dmbs-main">

        <div id="tabs" class="tabs">
    <nav>
        <ul>
            <li><a href="#section-0"><span>Zarząd</span></a></li>
            <li><a href="#section-1" ><span>Aktualni</span></a></li>
            <li><a href="#section-2" ><span>Byli</span></a></li>
            <li><a href="#section-3" ><span>Kandydaci</span></a></li>
        </ul>
    </nav>
    <div class="content">
        <section class="zarzad" id="section-0">
        					<?php
$args = array (
	'pagename'               => 'zarzad',
);

// The Query
$query = new WP_Query( $args );

                                          while($query->have_posts()) : $query->the_post();?>
                                        <?php the_content(); ?>
                                        <?php endwhile; ?>
        </section>
        <section id="section-1">
                <?php echo do_shortcode("[table id=1 /]"); ?>
        </section>
        <section id="section-2">
            <div class="special-div-for-grzegorz">
                        <div class="clip-circle col-xs-6"></div>
                        <div class="about-grzegorz col-xs-9">
                            <h2>Grzegorz Hajdukiewicz</h2>
                            <p>Przewodniczący w latach 2010 - 2013. Przejął on, prowadzone od 2006 roku przez doktora Jarosława Szreka, Międzywydziałowe Koło Naukowe Mechatroniki oraz zmienił jego nazwę na aktualną, dodając człon "Synergia".</p><p> Doktor Szrek natomiast stał się naszym opiekunem i pozostaje nim do dziś. Za kadencji Grześka Koło stało się rozpoznawalne na Politechnice Wrocławskiej, nazwa Synergia nie jest obca większości studentom naszej uczelni.</p>
                        </div>
                    </div>
                <?php echo do_shortcode("[table id=2 /]"); ?>
        </section>
        <section id="section-3">
                 <?php echo do_shortcode("[table id=3 /]"); ?>
        </section>

    </div><!-- /content -->
</div><!-- /tabs -->
    </div>
</div>
<script>
/**
 * cbpFWTabs.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
;( function( window ) {

	'use strict';

	function extend( a, b ) {
		for( var key in b ) {
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function CBPFWTabs( el, options ) {
		this.el = el;
		this.options = extend( {}, this.options );
  		extend( this.options, options );
  		this._init();
	}

	CBPFWTabs.prototype.options = {
		nav : 'nav',
		start : 0,
		skip : []
	};

	CBPFWTabs.prototype._init = function() {
		// tabs elemes
		this.tabs = [].slice.call( this.el.querySelectorAll( this.options.nav + ' > ul > li' ) );
		// content items
		this.items = [].slice.call( this.el.querySelectorAll( '.content > section' ) );
		// current index
		this.current = -1;
		// show current content item
		this._show();
		// init events
		this._initEvents();
	};

	CBPFWTabs.prototype._initEvents = function() {
		var self = this;
		var skip = this.options.skip;
        this.tabs.forEach( function( tab, idx ) {
            if (skip.indexOf(idx) == -1) {
                tab.addEventListener( 'click', function( ev ) {
                    ev.preventDefault();
                    self._show( idx );
                } );
            }
        } );
	};

	CBPFWTabs.prototype._show = function( idx ) {
		if( this.current >= 0 ) {
			// remove and add class thanks to Apollo.js (github.com/toddmotto/apollo)
            this.tabs[ this.current ].className = this.tabs[ this.current ].className.replace(new RegExp('(^|\\s)*' + 'tab-current' + '(\\s|$)*', 'g'), '');
            this.items[ this.current ].className = this.items[ this.current ].className.replace(new RegExp('(^|\\s)*' + 'content-current' + '(\\s|$)*', 'g'), '');
		}
		// change current
		this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
		this.tabs[ this.current ].className += (this.tabs[ this.current ].className ? ' ' : '') + 'tab-current';
		this.items[ this.current ].className += (this.items[ this.current ].className ? ' ' : '') + 'content-current';
	};

	// add to global namespace
	window.CBPFWTabs = CBPFWTabs;

})( window );


    new CBPFWTabs( document.getElementById( 'tabs' ) );
</script>


<?php get_footer(); ?>
