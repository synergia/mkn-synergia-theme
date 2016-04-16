<?php
class Walker_Simple_Example extends Walker_Nav_Menu {

    /**
     * At the start of each element, output a <li> and <a> tag structure.
     *
     * Note: Menu objects include url and title properties, so we will use those.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $activeMenuItemClass = (in_array('current-menu-item', $item->classes)) ? ' nav__item--current' : '';
        $output .= "<li class='nav__item ".$activeMenuItemClass."'><a class='link link--nav' href='".$item->url."'>".$item->title."</a></li>";
    }
}

?>
