<?php
/**
 * Plugin Name: WP i18n
 */
use Gettext\Translations;


add_action( 'add_meta_boxes', function() {
	add_meta_box( 'translated_strings_list', 'Translated Strings',  'translated_strings_meta_box_callback', 'wpi18n', 'normal', 'high' );
} );

function get_repeat_string_mapping( $post_ID ) {

	$excluded = array( '_edit_lock', 'original' );
	$all_meta = get_post_meta( $post_ID );
	$new_languages = array();
	foreach ($all_meta as $meta_key => $meta_value) {
		if ( strpos($meta_key, 'project_') === false && ! in_array($meta_key, $excluded)) {
			$lang = str_replace('language_', '', $meta_key);
        	foreach ($all_meta as $other_projects_meta_key => $other_projects_meta_value) {

        		$tempcount = 1;
				if ( strpos($other_projects_meta_key, 'language_'.$lang) !== false && strpos($other_projects_meta_key, 'project_') !== false ) {
					$meta_key_label = end(explode('project_wordpress-', $other_projects_meta_key));
					$meta_key_val   = $other_projects_meta_value[0];
					if( $meta_key_val ) {

						// Set all repeat strings from all available projects.
						$new_languages[$lang ]['all'][ $meta_key_label ] = $meta_key_val;

						// Set repeat strings with count.
						if( isset( $new_languages[$lang ]['repeat'][ $meta_key_val ] ) ) {
							$new_languages[$lang ]['repeat'][ $meta_key_val ] = $new_languages[$lang ]['repeat'][ $meta_key_val ] + $tempcount;
						} else {
							$new_languages[$lang ]['repeat'][ $meta_key_val ] = $tempcount;
						}
					}
				}
			}

			// Set top most repeat from all available strings.
			if( isset( $new_languages[$lang ]['repeat'] ) ) {
				$c   = 0;
				$top = '';
				$repeats = $new_languages[$lang ]['repeat'];
				foreach ($repeats as $j => $repeat) {
					if( $c < $repeat ) {
						$top = $j;
						$c = $repeat;
					}
				}
				$new_languages[$lang ]['top'] = $top;
			}
		}
	}
	return $new_languages;
	// echo '<pre>';
	// print_r( $new_languages );
	// echo '</pre>';
}

function translated_strings_meta_box_callback() {
	global $post;

	?>
	<h4>Original String</h4>
	<table class="widefat striped">
        <tr>
            <th><?php echo get_post_meta( $post->ID, 'original', true ); ?></th>
        </tr>
    </table>

	<?php
	$languages = get_repeat_string_mapping( $post->ID );
	?>
	<h4>Translation Strings</h4>
	<table class="widefat striped">
        <tr>
            <th><b>Language</b></th>
            <th><b>String</b></th>
        </tr>
        <?php
        // echo "<pre>";
        // print_r( $languages );
        foreach ($languages as $language_id => $language_data) { ?>
	        <tr>
	            <th><?php echo $language_id; ?></th>
	            <th>
	            	<p><b><?php echo $language_data['top']; ?></b></p>
	            	<?php
	            	$repeat = isset( $language_data['repeat'] ) ? $language_data['repeat'] : array();
	            	foreach ($repeat as $repeat_string => $repeat_string_count) {
	            		echo '('.$repeat_string_count.' times) ' . $repeat_string . '<br/>';
	            	} ?>
	            	<div>
	            		<span style="text-decoration: underline;" onClick="jQuery(this).siblings().slideToggle();">check all</span>
		            	<div style="display: none;">
		            	<?php
		            	$all = isset( $language_data['all'] ) ? $language_data['all'] : array();
		            	foreach ($all as $project => $string) {
		            		echo $string . ' ('.$project.')<br/>';
		            	}
						?>
		            	</div>
	            	</div>
	            </th>
	        </tr>
	    <?php } ?>
	</table>
	<?php
}

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function prefix_register_name() {

	$labels = array(
		'name'                => __( 'Strings', 'wpi18n' ),
		'singular_name'       => __( 'String', 'wpi18n' ),
		'add_new'             => _x( 'Add New String', 'wpi18n', 'wpi18n' ),
		'add_new_item'        => __( 'Add New String', 'wpi18n' ),
		'edit_item'           => __( 'Edit String', 'wpi18n' ),
		'new_item'            => __( 'New String', 'wpi18n' ),
		'view_item'           => __( 'View String', 'wpi18n' ),
		'search_items'        => __( 'Search Strings', 'wpi18n' ),
		'not_found'           => __( 'No Strings found', 'wpi18n' ),
		'not_found_in_trash'  => __( 'No Strings found in Trash', 'wpi18n' ),
		'parent_item_colon'   => __( 'Parent String:', 'wpi18n' ),
		'menu_name'           => __( 'Strings', 'wpi18n' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'show_in_rest'          => true,
		'rest_controller_class' => 'WP_REST_Terms_Controller',
		'capability_type'     => 'post',
		'supports'            => array( 'title', 'author', 'custom-fields' )
	);

	register_post_type( 'wpi18n', $args );

	
	// $labels = array(
	// 	'name'					=> _x( 'Translation Teams', 'Taxonomy Translation Teams', 'text-domain' ),
	// 	'singular_name'			=> _x( 'Translation Team', 'Taxonomy Translation Team', 'text-domain' ),
	// 	'search_items'			=> __( 'Search Translation Teams', 'text-domain' ),
	// 	'popular_items'			=> __( 'Popular Translation Teams', 'text-domain' ),
	// 	'all_items'				=> __( 'All Translation Teams', 'text-domain' ),
	// 	'parent_item'			=> __( 'Parent Translation Team', 'text-domain' ),
	// 	'parent_item_colon'		=> __( 'Parent Translation Team', 'text-domain' ),
	// 	'edit_item'				=> __( 'Edit Translation Team', 'text-domain' ),
	// 	'update_item'			=> __( 'Update Translation Team', 'text-domain' ),
	// 	'add_new_item'			=> __( 'Add New Translation Team', 'text-domain' ),
	// 	'new_item_name'			=> __( 'New Translation Team Name', 'text-domain' ),
	// 	'add_or_remove_items'	=> __( 'Add or remove Translation Teams', 'text-domain' ),
	// 	'choose_from_most_used'	=> __( 'Choose from most used text-domain', 'text-domain' ),
	// 	'menu_name'				=> __( 'Translation Team', 'text-domain' ),
	// );

	// $args = array(
	// 	'labels'            => $labels,
	// 	'public'            => true,
	// 	'show_in_nav_menus' => true,
	// 	'show_admin_column' => false,
	// 	'hierarchical'      => false,
	// 	'show_tagcloud'     => true,
	// 	'show_ui'           => true,
	// 	'query_var'         => true,
	// 	'rewrite'           => true,
	// 	'query_var'         => true,
	// 	'capabilities'      => array(),
	// );

	// register_taxonomy( 'wpi18n-teams', array( 'wpi18n' ), $args );

}

add_action( 'init', 'prefix_register_name' );

/**
 * MY CLASS NAME
 *
 * 1. Run `wp wpi18n info`, it will Insert & Update Products
 *
 * @package MY CLASS NAME
 * @since 1.0.0
 */

if( ! class_exists( 'WPI18N' ) && class_exists( 'WP_CLI_Command' ) ) :

	/**
	 * WPI18N
	 *
	 * @since 1.0.0
	 */
	class WPI18N extends WP_CLI_Command {

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			
		}

		/**
		 * Info
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function info() {

			WP_CLI::line( '***** Silence is Golden. *****' );

		}

		public function clean_tracking() {
			delete_option( 'wpi18n-404-urls' );
			delete_option( 'wpi18n-processed-urls' );

		}

		/**
		 * Info
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function download_all_core_files() {

			// @see https://make.wordpress.org/polyglots/teams/
			$polyglots_teams = array(
				'af'         => 'Afrikaans',
				'ak'         => 'Akan',
				'sq'         => 'Albanian',
				'arq'        => 'Algerian Arabic',
				'am'         => 'Amharic',
				'ar'         => 'Arabic',
				'hy'         => 'Armenian',
				'rup'        => 'Aromanian',
				'frp'        => 'Arpitan',
				'as'         => 'Assamese',
				'ast'        => 'Asturian',
				'az'         => 'Azerbaijani',
				'az-tr'      => 'Azerbaijani (Turkey)',
				'bcc'        => 'Balochi Southern',
				'ba'         => 'Bashkir',
				'eu'         => 'Basque',
				'bel'        => 'Belarusian',
				'bn'         => 'Bengali',
				'bs'         => 'Bosnian',
				'br'         => 'Breton',
				'bg'         => 'Bulgarian',
				'ca'         => 'Catalan',
				'bal'        => 'Catalan (Balear)',
				'ceb'        => 'Cebuano',
				'zh-cn'      => 'Chinese (China)',
				'zh-hk'      => 'Chinese (Hong Kong)',
				'zh-sg'      => 'Chinese (Singapore)',
				'zh-tw'      => 'Chinese (Taiwan)',
				'co'         => 'Corsican',
				'hr'         => 'Croatian',
				'cs'         => 'Czech',
				'da'         => 'Danish',
				'dv'         => 'Dhivehi',
				'nl'         => 'Dutch',
				'nl-be'      => 'Dutch (Belgium)',
				'dzo'        => 'Dzongkha',
				'art-xemoji' => 'Emoji',
				'en-au'      => 'English (Australia)',
				'en-ca'      => 'English (Canada)',
				'en-nz'      => 'English (New Zealand)',
				'pirate'     => 'English (Pirate)',
				'en-za'      => 'English (South Africa)',
				'en-gb'      => 'English (UK)',
				'eo'         => 'Esperanto',
				'et'         => 'Estonian',
				'ee'         => 'Ewe',
				'fo'         => 'Faroese',
				'fi'         => 'Finnish',
				'fr-be'      => 'French (Belgium)',
				'fr-ca'      => 'French (Canada)',
				'fr'         => 'French (France)',
				'fy'         => 'Frisian',
				'fur'        => 'Friulian',
				'fuc'        => 'Fulah',
				'gl'         => 'Galician',
				'ka'         => 'Georgian',
				'de'         => 'German',
				'de-ch'      => 'German (Switzerland)',
				'el'         => 'Greek',
				'kal'        => 'Greenlandic',
				'gn'         => 'Guaraní',
				'gu'         => 'Gujarati',
				'hat'        => 'Haitian Creole',
				'hau'        => 'Hausa',
				'haw'        => 'Hawaiian',
				'haz'        => 'Hazaragi',
				'he'         => 'Hebrew',
				'hi'         => 'Hindi',
				'hu'         => 'Hungarian',
				'is'         => 'Icelandic',
				'ido'        => 'Ido',
				'id'         => 'Indonesian',
				'ga'         => 'Irish',
				'it'         => 'Italian',
				'ja'         => 'Japanese',
				'jv'         => 'Javanese',
				'kab'        => 'Kabyle',
				'kn'         => 'Kannada',
				'kk'         => 'Kazakh',
				'km'         => 'Khmer',
				'kin'        => 'Kinyarwanda',
				'ko'         => 'Korean',
				'ckb'        => 'Kurdish (Sorani)',
				'kir'        => 'Kyrgyz',
				'lo'         => 'Lao',
				'lv'         => 'Latvian',
				'li'         => 'Limburgish',
				'lin'        => 'Lingala',
				'lt'         => 'Lithuanian',
				'lmo'        => 'Lombard',
				'lug'        => 'Luganda',
				'lb'         => 'Luxembourgish',
				'mk'         => 'Macedonian',
				'mg'         => 'Malagasy',
				'ms'         => 'Malay',
				'ml'         => 'Malayalam',
				'mlt'        => 'Maltese',
				'mri'        => 'Maori',
				'mr'         => 'Marathi',
				'mfe'        => 'Mauritian Creole',
				'xmf'        => 'Mingrelian',
				'mn'         => 'Mongolian',
				'me'         => 'Montenegrin',
				'ary'        => 'Moroccan Arabic',
				'mya'        => 'Myanmar (Burmese)',
				'ne'         => 'Nepali',
				'nb'         => 'Norwegian (Bokmål)',
				'nn'         => 'Norwegian (Nynorsk)',
				'oci'        => 'Occitan',
				'ory'        => 'Oriya',
				'os'         => 'Ossetic',
				'pap'        => 'Papiamento',
				'ps'         => 'Pashto',
				'fa'         => 'Persian',
				'fa-af'      => 'Persian (Afghanistan)',
				'pl'         => 'Polish',
				'pt-br'      => 'Portuguese (Brazil)',
				'pt'         => 'Portuguese (Portugal)',
				'pa'         => 'Punjabi',
				'rhg'        => 'Rohingya',
				'ro'         => 'Romanian',
				'roh'        => 'Romansh',
				'ru'         => 'Russian',
				'rue'        => 'Rusyn',
				'sah'        => 'Sakha',
				'sa-in'      => 'Sanskrit',
				'skr'        => 'Saraiki',
				'srd'        => 'Sardinian',
				'gd'         => 'Scottish Gaelic',
				'sr'         => 'Serbian',
				'sna'        => 'Shona',
				'sq-xk'      => 'Shqip (Kosovo)',
				'scn'        => 'Sicilian',
				'szl'        => 'Silesian',
				'snd'        => 'Sindhi',
				'si'         => 'Sinhala',
				'sk'         => 'Slovak',
				'sl'         => 'Slovenian',
				'so'         => 'Somali',
				'azb'        => 'South Azerbaijani',
				'es-ar'      => 'Spanish (Argentina)',
				'es-cl'      => 'Spanish (Chile)',
				'es-co'      => 'Spanish (Colombia)',
				'es-cr'      => 'Spanish (Costa Rica)',
				'es-gt'      => 'Spanish (Guatemala)',
				'es-mx'      => 'Spanish (Mexico)',
				'es-pe'      => 'Spanish (Peru)',
				'es-pr'      => 'Spanish (Puerto Rico)',
				'es'         => 'Spanish (Spain)',
				'es-ve'      => 'Spanish (Venezuela)',
				'su'         => 'Sundanese',
				'sw'         => 'Swahili',
				'ssw'        => 'Swati',
				'sv'         => 'Swedish',
				'gsw'        => 'Swiss German',
				'syr'        => 'Syriac',
				'tl'         => 'Tagalog',
				'tah'        => 'Tahitian',
				'tg'         => 'Tajik',
				'tzm'        => 'Tamazight (Central Atlas)',
				'ta'         => 'Tamil',
				'ta-lk'      => 'Tamil (Sri Lanka)',
				'tt'         => 'Tatar',
				'te'         => 'Telugu',
				'th'         => 'Thai',
				'bo'         => 'Tibetan',
				'tir'        => 'Tigrinya',
				'tr'         => 'Turkish',
				'tuk'        => 'Turkmen',
				'twd'        => 'Tweants',
				'ug'         => 'Uighur',
				'uk'         => 'Ukrainian',
				'ur'         => 'Urdu',
				'uz'         => 'Uzbek',
				'vi'         => 'Vietnamese',
				'wa'         => 'Walloon',
				'cy'         => 'Welsh',
				'xho'        => 'Xhosa',
				'yor'        => 'Yoruba',
				'zul'        => 'Zulu',
			);

			// Already processed.
			$wpi18n_404_urls       = get_option( 'wpi18n-404-urls', array() );
			$wpi18n_processed_urls = get_option( 'wpi18n-processed-urls', array() );

			foreach ($polyglots_teams as $polyglots_team => $polyglots_team_name) {

				// Translate WordPress, core projects, plugins, and themes into your language. Select your project below to get started.
				$defaults = array(
					'dev',
					'4.8.x',
					'4.7.x',
					'4.6.x',
					'4.5.x',
					'4.4.x',
					'4.3.x',
					'4.2.x',
					'4.1.x',
				);

				if( ! file_exists('po-files') ) {
					mkdir('po-files');
				}
				if( ! file_exists('po-files/wordpress') ) {
					mkdir('po-files/wordpress');
				}
				if( ! file_exists('po-files/wordpress/' . $polyglots_team) ) {
					mkdir('po-files/wordpress/' . $polyglots_team);
				}
			
				foreach ($defaults as $key => $directory) {

					if( ! file_exists('po-files/wordpress/'.$polyglots_team.'/'.$directory ) ) {
						mkdir('po-files/wordpress/'.$polyglots_team.'/'.$directory );
					}

					$releases = array(
						'wp/'.$directory.'/'.$polyglots_team.''              => 'https://translate.wordpress.org/projects/wp/'.$directory.'/'.$polyglots_team.'/default',
						'wp/'.$directory.'/cc/'.$polyglots_team.''           => 'https://translate.wordpress.org/projects/wp/'.$directory.'/cc/'.$polyglots_team.'/default',
						'wp/'.$directory.'/admin/'.$polyglots_team.''         => 'https://translate.wordpress.org/projects/wp/'.$directory.'/admin/'.$polyglots_team.'/default',
						'wp/'.$directory.'/admin/network/'.$polyglots_team.'' => 'https://translate.wordpress.org/projects/wp/'.$directory.'/admin/network/'.$polyglots_team.'/default',
					);

					foreach ($releases as $domain => $remote_file_url) {

						if( ! in_array($remote_file_url, $wpi18n_processed_urls) ) {

							$wpi18n_processed_urls[] = $remote_file_url;

							// Unique.
							$wpi18n_processed_urls = array_unique($wpi18n_processed_urls);

							update_option( 'wpi18n-processed-urls', $wpi18n_processed_urls );
							// WP_CLI::line( $remote_file_url );
							// WP_CLI::line(print_r( $wpi18n_processed_urls ) );
	
							// $domain    = 'wp/4.8.x/cc/ru';
							$file      = str_replace('/', '-', $domain);
							// $file_name = $file . '.po';
							$file_name = 'po-files/wordpress/'.$polyglots_team . '/'. $directory.'/'.$file . '.po';

							if( ! file_exists( $file_name ) ) {
								$request = wp_remote_get( $remote_file_url . '/export-translations', array( 'sslverify' => false, 'timeout' => 30000 ) );

								// Is WP Error?
								if ( is_wp_error( $request ) ) {
									WP_CLI::line( $request->get_error_message() );
								}

								// Invalid response code.
								if ( wp_remote_retrieve_response_code( $request ) != 200 ) {
									WP_CLI::line( 'ERROR URL: ' . $remote_file_url );
									WP_CLI::line( print_r( $request['response'] ) );
								}

								if( ! is_wp_error( $request ) && wp_remote_retrieve_response_code( $request ) == 200 ) {
									// Get body data.
									$body = wp_remote_retrieve_body( $request );
									WP_CLI::line( 'CREATED - ' . $file_name . ' | ' . $remote_file_url );

									file_put_contents( $file_name, $body);
								} else {
									$wpi18n_404_urls[] = $remote_file_url;

									// Unique.
									$wpi18n_404_urls = array_unique($wpi18n_404_urls);

									update_option( 'wpi18n-404-urls', $wpi18n_404_urls );
								}
							} else {
								WP_CLI::line( 'EXIST - ' . $file_name . ' from remote file ' . $remote_file_url );
							}
						} else {
							WP_CLI::line( 'PROCESSED ' . $remote_file_url );
						}


					}
				}
			}



			/**
			 * Russian
			 * Русский
			 * ru_RU
			 * Locale Glossary
			 * https://translate.wordpress.org/locale/ru
			 */

			// https://translate.wordpress.org/projects/wp/dev/ru/default
			// https://translate.wordpress.org/projects/wp/dev/cc/ru/default
			// https://translate.wordpress.org/projects/wp/dev/admin/ru/default
			// https://translate.wordpress.org/projects/wp/dev/admin/network/ru/default

			// https://translate.wordpress.org/projects/wp/4.8.x/ru/default
			// https://translate.wordpress.org/projects/wp/4.8.x/cc/ru/default
			// https://translate.wordpress.org/projects/wp/4.8.x/admin/ru/default
			// https://translate.wordpress.org/projects/wp/4.8.x/admin/network/ru/default

			// https://translate.wordpress.org/projects/wp/4.7.x/ru/default
			// https://translate.wordpress.org/projects/wp/4.7.x/cc/ru/default
			// https://translate.wordpress.org/projects/wp/4.7.x/admin/ru/default
			// https://translate.wordpress.org/projects/wp/4.7.x/admin/network/ru/default

			// https://translate.wordpress.org/projects/wp/4.6.x/ru/default
			// https://translate.wordpress.org/projects/wp/4.6.x/cc/ru/default
			// https://translate.wordpress.org/projects/wp/4.6.x/admin/ru/default
			// https://translate.wordpress.org/projects/wp/4.6.x/admin/network/ru/default

			// https://translate.wordpress.org/projects/wp/4.5.x/ru/default
			// https://translate.wordpress.org/projects/wp/4.5.x/cc/ru/default
			// https://translate.wordpress.org/projects/wp/4.5.x/admin/ru/default
			// https://translate.wordpress.org/projects/wp/4.5.x/admin/network/ru/default

			// https://translate.wordpress.org/projects/wp/4.4.x/ru/default
			// https://translate.wordpress.org/projects/wp/4.4.x/cc/ru/default
			// https://translate.wordpress.org/projects/wp/4.4.x/admin/ru/default
			// https://translate.wordpress.org/projects/wp/4.4.x/admin/network/ru/default

			// https://translate.wordpress.org/projects/wp/4.3.x/ru/default
			// https://translate.wordpress.org/projects/wp/4.3.x/cc/ru/default
			// https://translate.wordpress.org/projects/wp/4.3.x/admin/ru/default
			// https://translate.wordpress.org/projects/wp/4.3.x/admin/network/ru/default

			// https://translate.wordpress.org/projects/wp/4.3.x/ru/default
			// https://translate.wordpress.org/projects/wp/4.3.x/cc/ru/default
			// https://translate.wordpress.org/projects/wp/4.3.x/admin/ru/default
			// https://translate.wordpress.org/projects/wp/4.3.x/admin/network/ru/default

			// https://translate.wordpress.org/projects/wp/4.1.x/ru/default
			// https://translate.wordpress.org/projects/wp/4.1.x/cc/ru/default
			// https://translate.wordpress.org/projects/wp/4.1.x/admin/ru/default
			// https://translate.wordpress.org/projects/wp/4.1.x/admin/network/ru/default

			// ----
			// https://translate.wordpress.org/projects/wp/4.8.x/ru/default/export-translations
			// https://translate.wordpress.org/projects/wp/4.8.x/cc/ru/default/export-translations/wp-4.8.x-cc-ru.po

			// $domain    = 'wp/4.8.x/cc/ru';
			// $file      = str_replace('/', '-', $domain);
			// $file_name = $file . '.po';

			// $request = wp_remote_get( 'https://translate.wordpress.org/projects/'.$domain.'/default/export-translations/' );

			// // Is WP Error?
			// if ( is_wp_error( $request ) ) {
			// 	WP_CLI::error( $request->get_error_message() );
			// }

			// // Invalid response code.
			// if ( wp_remote_retrieve_response_code( $request ) != 200 ) {
			// 	WP_CLI::error( $request['response'] );
			// }

			// // Get body data.
			// $body = wp_remote_retrieve_body( $request );

			// file_put_contents( $file_name, $body);
		}

		/**
		 * Info
		 *
		 * @since 1.0.0
		 * @return void
		 */
		function getDirContents($dir, &$results = array()){
		    $files = scandir($dir);

		    foreach($files as $key => $value){
		        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
		        if(!is_dir($path)) {
		            $results[] = $path;
		        } else if($value != "." && $value != "..") {
		            $this->getDirContents($path, $results);
		            // $results[] = $path;
		        }
		    }

		    return $results;
		}

		/**
		 * wp wpi18n import
		 * @return [type] [description]
		 */
		public function import() {

			include_once "lib/Gettext/src/autoloader.php";
			include_once "lib/cldr-to-gettext-plural-rules-master/src/autoloader.php";

			// it_IT = Italiano
			$files = $this->getDirContents('po-files/wordpress/it');
			$files_count = count( $files );

			// WP_CLI::line( print_r( $files ));
			// // WP_CLI::error(dirname(__FILE__) . '\wp-dev-ru.po');
			// WP_CLI::error('ok');

			foreach ($files as $key => $file) {
				// WP_CLI::error( basename($file) );
				
				//import from a .po file:
				$translations = Translations::fromPoFile( $file );
				// $translations = Translations::fromPoFile( dirname(__FILE__) . '\wp-dev-ru.po' );
				$translations_count = count( $translations );

				// $file_name  = 'bbpress-2.4.x-ru.po';
				$file_name  = basename($file);

				$language   = $translations->getHeader( 'Language' );
				$project_id = $translations->getHeader( 'Project-Id-Version' );
				$domain     = $translations->getDomain();
				
				$line = 1;

				foreach ($translations as $key => $translation) {
					// echo 'getOriginal : ---- ' . $translation->getOriginal() . '<br/>';
					// echo 'getTranslation : ---- ' . $translation->getTranslation() . '<br/>';

					$post_title         = $translation->getOriginal();
					$small_post_title   = substr($post_title, 0, 80) . '..';
					$translation_string = $translation->getTranslation();

					if( ! empty( $post_title ) ) {

						$post_id = post_exists( $post_title );

						if( $post_id ) {
							// Exist.
							// WP_CLI::line( $language . ' | ' . $line . ' | EXIST | ' . $post_id . ' | ' . $small_post_title . ' | UPDATED WITH ' . $translation_string );

							// Original String.
							update_post_meta( $post_id, 'original', $post_title );

							// Translated String.
							update_post_meta( $post_id, 'language_'.$language, $translation_string );

							// SAME Translated String from all other projects.
							// Unique key should be: "language_{}_project_{}"
							$translation_key = 'language_'.$language.'_project_'.sanitize_title( $project_id );
							update_post_meta( $post_id, $translation_key, $translation_string );
						} else {
							$new_post = array(
								'post_type'  => 'wpi18n',
								'post_title' => $post_title,
							);
							$post_id = wp_insert_post( $new_post );

							if( ! is_wp_error( $post_id ) ) {

								// Original String.
								update_post_meta( $post_id, 'original', $post_title );

								// Translated String.
								update_post_meta( $post_id, 'language_'.$language, $translation_string );

								// Uniq key should be: "language_{}_project_{}"
								$translation_key = 'language_'.$language.'_project_'.sanitize_title( $project_id );
								update_post_meta( $post_id, $translation_key, $translation_string );

								// Created.
								// WP_CLI::line( $language . ' | ' . $line . ' | CREATED | ' . $post_id . ' | ' . $small_post_title . ' | UPDATED WITH ' . $translation_string );
							} else {
								// WP_CLI::line( $language . ' | ' . $line . ' | ERROR | ' . $post_id->get_wp_error() );
								// WP_CLI::line( ' | ' . $post_id . ' | ' . $small_post_title );
							}
						}
					} else {
						// WP_CLI::line( $post_title );
					}

					WP_CLI::line( $language.' | '.$files_count.' | '.$translations_count.' | '.$file_name );

					$line++;
					$translations_count--;
				}

				$files_count--;

				WP_CLI::line( '-------------------');
				WP_CLI::line( 'Strings ' . count( $translations ) );
				WP_CLI::line( 'File Name ' . $file_name );
				WP_CLI::line( 'Language ' . $language );
				WP_CLI::line( 'Project ID ' . $project_id );
				WP_CLI::line( 'Domain ' . $domain );

				// //edit some translations:
				// $translation = $translations->find(null, 'apple');

				// if ($translation) {
				// 	$translation->setTranslation('Mazá');
				// }

				// //export to a php array:
				// $translations->toPhpArrayFile('locales/gl.php');

				// //and to a .mo file
				// $translations->toMoFile('Locale/gl/LC_MESSAGES/messages.mo');
			}
		}

		function translate() {
			include_once "lib/Gettext/src/autoloader.php";
			include_once "lib/cldr-to-gettext-plural-rules-master/src/autoloader.php";


			$translations = Translations::fromPoFile( dirname(__FILE__) . '\wp-themes-astra-mr.po' );

			// WP_CLI::error(print_r( $translations ) );

			foreach ($translations as $key => $translation) {
				// echo 'getOriginal : ---- ' . $translation->getOriginal() . '<br/>';
				// echo 'getTranslation : ---- ' . $translation->getTranslation() . '<br/>';

				$post_title         = $translation->getOriginal();
				$small_post_title   = substr($post_title, 0, 80) . '..';
				$translation_string = $translation->getTranslation();

				if( ! empty( $post_title ) ) {
					$post_id = post_exists( $post_title );
					if( $post_id ) {
						$stored_string = get_post_meta( $post_id, 'language_mr', true );
						WP_CLI::line( $post_id . " " . get_post_meta( $post_id, 'language_mr', true ) );
						
						//edit some translations:
						$translation = $translations->find(null, $post_title);

						if ($translation) {
							$translation->setTranslation( $stored_string );
						}
					}
				}

			}

			//Now save a po file with the result
			$translations->toPoFile('locale.po');

			// //export to a php array:
			// $translations->toPhpArrayFile('locales/gl.php');

			// //and to a .mo file
			// $translations->toMoFile('Locale/gl/LC_MESSAGES/messages.mo');

		}

		function test() {

			include_once "lib/Gettext/src/autoloader.php";
			include_once "lib/cldr-to-gettext-plural-rules-master/src/autoloader.php";

			$translations = Translations::fromPoFile( dirname(__FILE__) . '\wp-themes-astra-mr.po' );

			foreach ($translations as $key => $translation) {

				$post_title         = $translation->getOriginal();
				$translation_string = $translation->getTranslation();

				if( ! empty( $post_title ) ) {
					$post_id = post_exists( $post_title );
					if( $post_id ) {
						$stored_string = get_post_meta( $post_id, 'language_mr', true );
						WP_CLI::line( $post_id . " " . $stored_string );

						$excluded = array( '_edit_lock', 'original' );
						$all_meta = get_post_meta( $post_id );
						foreach ($all_meta as $other_projects_meta_key => $other_projects_meta_value) {
							if ( strpos($other_projects_meta_key, 'project_') !== false ) {
								WP_CLI::line( $other_projects_meta_value[0] );
								
								// $meta_key_label = end(explode('project_wordpress-', $other_projects_meta_key));
								// $meta_key_val   = get_post_meta( $post_id, $other_projects_meta_key, true );
								// if( $meta_key_val ) {
								// 	$meta_key_val   = substr($meta_key_val, 0, 80);
								// 	echo $meta_key_val . ' ('.$meta_key_label.')<br/>';
								// }
							}
						}
					}
				}

			}
		}

	}

	/**
	 * Add Command
	 */
	WP_CLI::add_command( 'wpi18n', 'WPI18N' );

endif;