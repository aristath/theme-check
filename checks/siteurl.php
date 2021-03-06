<?php // phpcs:ignore WordPress.Files.FileName
/**
 * Checks if site_url is used, and adds an info.
 *
 * @link https://developer.wordpress.org/reference/functions/site_url/
 */

/**
 * Check for site_url
 */
class SiteUrlCheck implements themecheck {
	/**
	 * Error messages, warnings and info notices.
	 *
	 * @var array $error
	 */
	protected $error = array();

	/**
	 * Check that return true for good/okay/acceptable, false for bad/not-okay/unacceptable.
	 *
	 * @param array $php_files File paths and content for PHP files.
	 * @param array $css_files File paths and content for CSS files.
	 * @param array $other_files Folder names, file paths and content for other files.
	 */
	public function check( $php_files, $css_files, $other_files ) {

		$ret = true;

		checkcount();
		foreach ( $php_files as $file_path => $file_content ) {
			$filename = tc_filename( $file_path );

			if ( strpos( $file_content, 'site_url' ) !== false ) {
				$this->error[] = sprintf(
					'<span class="tc-lead tc-info">' . __( 'INFO', 'theme-check' ) . '</span>: ' . __( 'site_url() or get_site_url() was found in %1$s. site_url() references the URL where the WordPress files are located. Use home_url() if the intention is to point to the site address (home page), and in the search form.', 'theme-check' ),
					'<strong>' . $filename . '</strong>'
				);
			}
		}
		return $ret;
	}

	/**
	 * Get error messages from the checks.
	 *
	 * @return array Error message.
	 */
	public function getError() {
		return $this->error;
	}
}

$themechecks[] = new SiteUrlCheck();
