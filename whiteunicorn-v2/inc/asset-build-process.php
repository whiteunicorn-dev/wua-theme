<?php

/**
 * If running locally, check for Vite's dev server.
 * Optionally define a global constant that adds HMR/Live Reload assets.
 */
if (
	! empty( $_SERVER['REMOTE_ADDR'] )
	&&
	(
		in_array( $_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'] ) // same device
		||
		strpos( $_SERVER['REMOTE_ADDR'], '192.168.' ) !== false // same network
	)
) {
	$base_url = 'http://localhost';

	if ( is_admin() ) {
		if ( app_check_if_asset_dev_server_is_reachable( $base_url, 3737 ) ) {
			define( 'APP_ASSET_LIVE_RELOAD_URL_ADMIN', $base_url . ':3737' );
		}
	} elseif ( app_check_if_asset_dev_server_is_reachable( $base_url, 3636 ) ) {
		define( 'APP_ASSET_LIVE_RELOAD_URL', $base_url . ':3636' );
	}
}

/**
 * Prepare for front-end dev mode.
 */
if ( defined( 'APP_ASSET_LIVE_RELOAD_URL' ) ) {
	add_action( 'wp_head', function() {
		echo '<script type="module" src="' . APP_ASSET_LIVE_RELOAD_URL . '/@vite/client"></script>';
	} );

	add_action( 'wp_enqueue_scripts', function() {
		// check if production scripts are enqueued
		if ( wp_script_is( 'theme-js-bundle', 'enqueued' ) ) {
			// modify JS bundle <script> tag to enable Live Reload
			add_action( 'script_loader_tag', function( $tag, $handle, $src ) {
				if ( $handle === 'theme-js-bundle' ) {
					$tag = '<script type="module" src="' . APP_ASSET_LIVE_RELOAD_URL . '/js/main.js"></script>';
				}

				return $tag;
			}, 10, 3 );
		} else {
			wp_enqueue_script( 'jquery' );

			// print Live Reload script in footer
			add_action( 'wp_footer', function() {
				echo '<script type="module" src="' . APP_ASSET_LIVE_RELOAD_URL . '/js/main.js"></script>';
			} );
		}

		// check if production styles are enqueued
		if ( wp_style_is( 'theme-css-bundle', 'enqueued' ) ) {
			// modify CSS bundle <link> tag to enable HMR
			add_action( 'style_loader_tag', function( $tag, $handle, $href, $media ) {
				if ( $handle === 'theme-css-bundle' ) {
					$tag = '<link rel="stylesheet" href="' . APP_ASSET_LIVE_RELOAD_URL . '/scss/load.scss">';
				}

				return $tag;
			}, 10, 4 );
		} else {
			// print HMR link in head
			add_action( 'wp_head', function() {
				echo '<link rel="stylesheet" href="' . APP_ASSET_LIVE_RELOAD_URL . '/scss/load.scss">';
			} );
		}
	} );
}

/**
 * Deque admin production assets and prepare for dev mode.
 */
if ( defined( 'APP_ASSET_LIVE_RELOAD_URL_ADMIN' ) ) {
	add_action( 'enqueue_block_editor_assets', function() {
		wp_dequeue_style( 'admin-css-bundle' );

		echo '<script type="module" src="' . APP_ASSET_LIVE_RELOAD_URL_ADMIN . '/@vite/client"></script>';
		echo '<link rel="stylesheet" href="' . APP_ASSET_LIVE_RELOAD_URL_ADMIN . '/scss/load-admin.scss">';
	} );
}

/**
 * Get the asset manifest data.
 *
 * @param bool $admin
 *
 * @return array
 */
function app_get_manifest( bool $admin = false ) {
	$manifest_path = WUA_THEME_DIR . 'dist/' . ( $admin ? 'admin/' : '' ) .  'manifest.json';

	return file_exists( $manifest_path ) ? json_decode( file_get_contents( $manifest_path ), true ) : [];
}

/**
 * Vite's dev/start commands serve assets on ports 3636 and 3737.
 * This function will try connecting using curl or fsockopen.
 *
 * If the dev server is not reachable the requests will time out,
 * blocking page load by up to 500/2500 milliseconds (curl is faster).
 *
 * @param string $base_url
 * @param int $port
 *
 * @return bool
 */
function app_check_if_asset_dev_server_is_reachable( string $base_url, int $port ): bool {
	if ( function_exists( 'curl_init' ) ) {
		$curl = curl_init( $base_url );
		curl_setopt( $curl, CURLOPT_PORT , $port );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $curl, CURLOPT_TIMEOUT_MS, 500 );
		$result = curl_exec( $curl );
		curl_close( $curl );
	} else {
		$result = @fsockopen(
			parse_url( $base_url, PHP_URL_HOST ),
			$port,
			$error_code,
			$error_message,
			2.5
		);
	}

	return $result !== false;
}
