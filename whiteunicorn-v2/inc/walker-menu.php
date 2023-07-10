<?php
class WUA_Menu_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		$output .= "<li class='" .  implode(" ", $item->classes) . "'>";
 
		$output .= '<a href="' . $item->url . '">';

        if ( $args->menu->slug === 'main-menu' ) {
            $output .= '<span>' . $item->title . '</span>';
            $output .= '<span>' . $item->title . '</span>';
        }
        else {
            $output .= $item->title;
        }
 
		$output .= '</a>';//<pre>' . print_r( $args, true ) . '</pre>';  
	}
}