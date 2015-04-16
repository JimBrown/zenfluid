<?php
// force UTF-8 Ø

/* Plug-in for theme option handling
 * The Admin Options page tests for the presence of this file in a theme folder
 * If it is present it is linked to with a require_once call.
 * If it is not present, no theme options are displayed.
 *
 */

class ThemeOptions {

	function ThemeOptions() {
		
		if (!extensionEnabled('zenpage')) enableExtension('zenpage', 8291, true);
		if (!extensionEnabled('print_album_menu')) enableExtension('print_album_menu', 1025, true);
		
		setThemeOptionDefault('Use_thickbox', true);
		setThemeOptionDefault('Allow_search', true);
		setThemeOptionDefault('zenfluid_menuupper', false);
		setThemeOptionDefault('zenfluid_titlebreadcrumb', false);
		setThemeOptionDefault('zenfluid_randomimage', true);
		setThemeOptionDefault('zenfluid_imageroot', '');
		setThemeOptionDefault('zenfluid_transitionnewrow', true);
		setThemeOptionDefault('zenfluid_showheader', false);
		setThemeOptionDefault('zenfluid_commentwidth', 'auto');
		setThemeOptionDefault('zenfluid_menutitles', true);
		setThemeOptionDefault('zenfluid_makeneat', false);
		setThemeOptionDefault('zenfluid_titlemargin', 50);
		setThemeOptionDefault('zenfluid_titletop', false);
		setThemeOptionDefault('albums_per_page', 20);
		setThemeOptionDefault('albums_per_row', 20);
		setThemeOptionDefault('images_per_page', 50);
		setThemeOptionDefault('images_per_row', 50);
		setThemeOptionDefault('image_size', 1920, NULL, 'zenpage');
		setThemeOptionDefault('image_use_side', 'width', NULL, 'zenpage');
		setThemeOptionDefault('thumb_size',100, NULL, 'zenpage');
		setThemeOptionDefault('thumb_crop_width', 100);
		setThemeOptionDefault('thumb_crop_height', 100);
		setThemeOptionDefault('thumb_crop', 1);
		setThemeOptionDefault('thumb_transition', 1);
		setOptionDefault('colorbox_zenfluid_album', 1);
		setOptionDefault('colorbox_zenfluid_image', 1);
		setOptionDefault('colorbox_zenfluid_search', 1);
		if (class_exists('cacheManager')) {
			$me = basename(dirname(__FILE__));
			cacheManager::deleteThemeCacheSizes($me);
			cacheManager::addThemeCacheSize($me, NULL, 1920, 1920, NULL, NULL, NULL, NULL, NULL, false, getOption('fullimage_watermark'), true);
			cacheManager::addThemeCacheSize($me, 100, NULL, NULL, getThemeOption('thumb_crop_width'), getThemeOption('thumb_crop_height'), NULL, NULL, true, getOption('Image_watermark'), NULL, NULL);
		}
	}
	function getOptionsSupported() {
	
		$list = array();
		genAlbumList($list);
		foreach ($list as $fullfolder => $albumtitle) {
			$list[$fullfolder] = $fullfolder;
		}
		$list['*All Albums*'] = '';

	
		$options = array(	gettext('Use Colorbox') => array('key' => 'Use_thickbox','order' => 4, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Enable to display full size image with Colorbox.')),
							gettext('Allow search')	=> array('key' => 'Allow_search','order' => 3, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Enable search form.')),
							gettext('Use UPPERCASE menu') => array('key' => 'zenfluid_menuupper','order' => 6, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Enable if you want all menu entries to be uppercase')),
							gettext('Random/Latest image root folder') => array('key' => 'zenfluid_imageroot','order' => 8, 'type' => OPTION_TYPE_SELECTOR, 'selections' => $list, 'desc' => gettext('Optional: Select the name of the album folder from which the random or latest image will be taken.')),
							gettext('Use random image') => array('key' => 'zenfluid_randomimage','order' => 7, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Enable if you want a random image displayed on the home page, otherwise the latest image will be displayed')),
							gettext('Transition on new row') => array('key' => 'zenfluid_transitionnewrow','order' => 10, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('If combined transition is selected above, enable this if you wish the transition to start on a new row, otherwise the transition will continue on the same row')),
							gettext('Show header') => array('key' => 'zenfluid_showheader','order' => 11, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Enable to show a header with gallery title and description across the top of the screen instead of at the top of the sidebar')),
							gettext('Comment stage maximum width') => array('key' => 'zenfluid_commentwidth','order' => 12, 'type' => OPTION_TYPE_TEXTBOX, 'desc' => gettext('Enter the maximum width (in pixels) that the comment stage (title, buttons, comments, comment entry form) should take. <p class="notebox"><strong>Note:</strong> "auto" will always take as much width as it can.</p>')),
							gettext('Menu section titles') => array('key' => 'zenfluid_menutitles','order' => 13, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Enable the display of a title for each sidebar menu section.')),
							gettext('Print title breadcrumb') => array('key' => 'zenfluid_titlebreadcrumb','order' => 9, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Enable this if you want the album title to be included before the image title')),
							gettext('Title Margin') => array('key' => 'zenfluid_titlemargin','order' => 14, 'type' => OPTION_TYPE_TEXTBOX, 'desc' => gettext('Set amount of the Title, buttons, comments that alwas show below the image or video')),
							gettext('Title on top') => array('key' => 'zenfluid_titletop','order' => 15, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Enable this if you want the image title to be displayed above the image')),
							gettext('Make Neat') => array('key' => 'zenfluid_makeneat','order' => 99, 'type' => OPTION_TYPE_CHECKBOX, 'desc' => gettext('Enabling this option will result in the html output to be buffered and captured, the head section consolidated, all scripts moved to the head section, and the body section neatened with appropriate line splitting, concatenating, and tabbing and then everything sent to the browser. This option will add processing time to the page.'))
							);
	return $options;
	}

  function getOptionsDisabled() {
  	return array('custom_index_page','albums_per_row','images_per_row');
  }

	function handleOption($option, $currentValue) {
	}
}
?>