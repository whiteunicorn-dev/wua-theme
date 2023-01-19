<?php
/**
 * Custom Shortcode Functions
 *
 * @package WhiteUnicorn
 */


/**
 * Current Year
 * @uses [year]
 */
function current_year() {
	return date("Y");
}
add_shortcode('year', 'current_year');


/**
 * Link
 * @uses [link][/link]
 */
function shortcode_link( $atts, $content ) {
	$href = ( isset( $atts['url'] ) ) ? $atts['url'] : '#';
	$target = ( isset( $atts['target'] ) ) ? $atts['target'] : '_self';
	$class = ( isset( $atts['class'] ) ) ? $atts['class'] : '';
	
	ob_start(); ?>
	<a href="<?php echo esc_url( $href ); ?>" class="<?php echo $class; ?>" target="<?php echo $target; ?>"><?php echo $content; ?></a>
	<?php
	return ob_get_clean();
}
add_shortcode( 'link', 'shortcode_link' );


/**
 * Phone Link
 * @uses [phone][/phone]
 */
function shortcode_phone( $atts, $content ) {
	$href = 'tel:';
	$href .= ( isset( $atts['number'] ) ) ? $atts['number'] : $content;
	$class = ( isset( $atts['class'] ) ) ? $atts['class'] : '';
	ob_start(); ?>
	<a href="<?php echo $href; ?>" class="<?php echo $class; ?>"><?php echo $content; ?></a>
	<?php
	return ob_get_clean();
}
add_shortcode( 'phone', 'shortcode_phone' );


/**
 * Display List Items
 * @uses [list][/list]
 */
function list_shortcode( $atts, $content = null ) {
	$listItems = preg_split("/\r\n|\n|\r/", $content);
	$html = ( isset( $atts['classname'] ) ) ? '<ul class="' . $atts['classname'] . '">' : '<ul>';
	foreach ( $listItems as $item ) {
		if ( $item != '' ) { $html .= '<li>' . $item . '</li>'; }
	}
	$html .= '</ul>';
	
	return $html;
}
add_shortcode('list', 'list_shortcode');


/**
 * Make Bold
 * @uses [bold][/bold]
 */
function shortcode_bold( $atts, $content ) {
	ob_start();
	?>
	<strong><?php echo esc_html( $content ); ?></strong>
	<?php
	return ob_get_clean();
}
add_shortcode( 'bold', 'shortcode_bold' );


/**
 * Make Italic
 * @uses [italic][/italic]
 */
function shortcode_italic( $atts, $content ) {
	ob_start();
	?>
	<i><?php echo esc_html( $content ); ?></i>
	<?php
	return ob_get_clean();
}
add_shortcode( 'italic', 'shortcode_italic' );


/**
 * Add break tag
 * @uses [br]
 */
function shortcode_br_tag() {
	ob_start();
	?>
	<br>
	<?php
	return ob_get_clean();
}
add_shortcode( 'br', 'shortcode_br_tag' );


/**
 * Creates a column
 * @uses [col][/col]
 */
function shortcode_col( $atts, $content ) {
	if ( empty( $content ) || empty( $atts['width'] ) ) {
		return;
	}

	switch ( $atts['width'] ) {
		case '1/2':
			$class = 'col basis-50 ';
			break;
		case '1/3':
			$class = 'col basis-33 ';
			break;
		default:
			return;
	}

	$class .= ( $atts['class'] ) ?: '';

	ob_start();
	?>
	<div class="<?php echo esc_attr( $class ); ?>">
		<?php echo do_shortcode( $content ); ?>
	</div><!-- /.cols -->
	<?php
	$html = ob_get_clean();

	return $html;
}
add_shortcode( 'col', 'shortcode_col' );


/**
 * Creates a column holder
 * @uses [cols][/cols]
 */
function shortcode_cols( $atts, $content ) {
	if ( empty( $content ) || ! strpos( $content, '[col width' ) ) {
		return;
	}

	$class = ( $atts['class'] ) ?: '';

	ob_start();
	?>
	<div class="flex-cnt <?php echo $class; ?>" <?php if ( $atts['gap'] ) { echo 'data-flex-gap="' . $atts['gap'] . '"'; } ?>>
		<?php echo do_shortcode( $content ); ?>
	</div>
	<?php
	$html = ob_get_clean();

	return $html;
}
add_shortcode( 'cols', 'shortcode_cols' );


/**
 * HTML tag
 * @uses [htmlTag][/htmlTag]
 */
function shortcode_htmlTag( $atts, $content ) {
	$tag = ( isset( $atts['tag'] ) ) ? $atts['tag'] : 'p';
	$class = ( isset( $atts['class'] ) ) ? $atts['class'] : '';
	ob_start();
	
	echo '<' . $tag . ' class="' . $class . '">' . do_shortcode( $content ) . '</' . $tag . '>';
	
	return ob_get_clean();
}
add_shortcode( 'htmlTag', 'shortcode_htmlTag' );








