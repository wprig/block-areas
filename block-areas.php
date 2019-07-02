<?php
/**
 * Plugin initialization file
 *
 * @package WP_Rig\Block_Areas
 * @license GNU General Public License v2 (or later)
 * @link    https://wordpress.org/plugins/block-areas
 *
 * @wordpress-plugin
 * Plugin Name: Block Areas
 * Plugin URI:  https://wordpress.org/plugins/block-areas
 * Description: Introduces a simple method for defining block areas to use the block editor outside of the post content.
 * Version:     0.1.0
 * Author:      The WP Rig Contributors
 * Author URI:  https://github.com/wprig
 * License:     GNU General Public License v2 (or later)
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: block-areas
 */

/* This file must be parseable by PHP 5.2. */

/**
 * Gets the block areas API instance.
 *
 * Do not call this function before the plugin has been loaded.
 *
 * @since 0.1.0
 *
 * @return WP_Rig\Block_Areas\Block_Areas
 */
function block_areas() {
	return call_user_func( [ 'WP_Rig\\Block_Areas\\Plugin', 'instance' ] )->block_areas();
}

/**
 * Loads the plugin.
 *
 * @since 0.1.0
 */
function block_areas_load() {
	if ( version_compare( phpversion(), '7.0', '<' ) ) {
		add_action( 'admin_notices', 'block_areas_display_php_version_notice' );
		return;
	}

	if ( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ) {
		add_action( 'admin_notices', 'block_areas_display_wp_version_notice' );
		return;
	}

	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		require __DIR__ . '/vendor/autoload.php';
	}

	call_user_func( [ 'WP_Rig\\Block_Areas\\Plugin', 'load' ], __FILE__ );
}

/**
 * Displays an admin notice about an unmet PHP version requirement.
 *
 * @since 0.1.0
 */
function block_areas_display_php_version_notice() {
	?>
	<div class="notice notice-error">
		<p>
			<?php
			sprintf(
				/* translators: 1: required version, 2: currently used version */
				__( 'Block Areas requires at least PHP version %1$s. Your site is currently running on PHP %2$s.', 'block-areas' ),
				'7.0',
				phpversion()
			);
			?>
		</p>
	</div>
	<?php
}

/**
 * Displays an admin notice about an unmet WordPress version requirement.
 *
 * @since 0.1.0
 */
function block_areas_display_wp_version_notice() {
	?>
	<div class="notice notice-error">
		<p>
			<?php
			sprintf(
				/* translators: 1: required version, 2: currently used version */
				__( 'Block Areas requires at least WordPress version %1$s. Your site is currently running on WordPress %2$s.', 'block-areas' ),
				'5.0',
				get_bloginfo( 'version' )
			);
			?>
		</p>
	</div>
	<?php
}

block_areas_load();
