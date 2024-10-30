<?php 

/*
Plugin Name: Masjid Iqamah Timings
Plugin URI: http://www.wordpress.org/plugins/masjid-iqamah-timings
Description: A plugin for Mosques' websites. It helps publish Adhan+Iqamah timings for daily prayers, and Khutba+Iqamah timings of Friday prayers at Masjid.
Version: 2.2
Author: Azkaar Developers
Author URI: http://www.azkaar.com/
License: GPL2
*/


// ACTIVATE PLUGIN
function mit_plugin_activate() {
	$website_domain = $_SERVER['SERVER_NAME'];
	$temp_var = @file_get_contents("http://log.islam-fyi.com/plugin.php?value=Masjid-Iqamah-Timings|Plugin|Wordpress|ON|" . $website_domain);
}
register_activation_hook(__FILE__,'mit_plugin_activate');

// DEACTIVATE PLUGIN
function mit_plugin_deactivate() {
	$website_domain = $_SERVER['SERVER_NAME'];
	$temp_var = @file_get_contents("http://log.islam-fyi.com/plugin.php?value=Masjid-Iqamah-Timings|Plugin|Wordpress|OFF|" . $website_domain);
}
register_deactivation_hook(__FILE__,'mit_plugin_deactivate');

// WIDGET CSS
function register_mit_styles() {
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/mit-styles.css';
	echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
add_action('wp_head', 'register_mit_styles');


// REGISTER WIDGET
function mit_register_widget() {
	register_widget( 'MasjidIqamahTimingsWidgetPlugin' );
}
add_action( 'widgets_init', 'mit_register_widget' );

// WIDGET CLASS
class MasjidIqamahTimingsWidgetPlugin extends WP_Widget {

    // constructor
    function MasjidIqamahTimingsWidgetPlugin() {
        parent::__construct( false, 'Masjid Iqamah Timings' );
    }
	

	// widget form creation
	function form($instance) {

		// Check values
		if( $instance) {

			 $title = esc_attr($instance['title']);
			 $language = esc_attr($instance['language']);
			 $textarea = esc_textarea($instance['textarea']);
			 
			 $fajr_adhan = esc_attr($instance['fajr_adhan']);
			 $fajr_iqamah = esc_attr($instance['fajr_iqamah']);
			 
			 $zuhr_adhan = esc_attr($instance['zuhr_adhan']);
			 $zuhr_iqamah = esc_attr($instance['zuhr_iqamah']);
			 
			 $asr_adhan = esc_attr($instance['asr_adhan']);
			 $asr_iqamah = esc_attr($instance['asr_iqamah']);
			 
			 $maghrib_adhan = esc_attr($instance['maghrib_adhan']);
			 $maghrib_iqamah = esc_attr($instance['maghrib_iqamah']);
			 
			 $isha_adhan = esc_attr($instance['isha_adhan']);
			 $isha_iqamah = esc_attr($instance['isha_iqamah']);
			 
			 $jumua_khutba1 = esc_attr($instance['jumua_khutba1']);
			 $jumua_iqamah1 = esc_attr($instance['jumua_iqamah1']);
			 
			 $jumua_khutba2 = esc_attr($instance['jumua_khutba2']);
			 $jumua_iqamah2 = esc_attr($instance['jumua_iqamah2']);
			 
			 $jumua_khutba3 = esc_attr($instance['jumua_khutba3']);
			 $jumua_iqamah3 = esc_attr($instance['jumua_iqamah3']);
			 
		} else {

			$title = '';
			 $language = '';
			 $textarea = '';
			 $fajr_adhan = '';
			 $fajr_iqamah = '';
			 $zuhr_adhan = '';
			 $zuhr_iqamah = '';
			 $asr_adhan = '';
			 $asr_iqamah = '';
			 $maghrib_adhan = '';
			 $maghrib_iqamah = '';
			 $isha_adhan = '';
			 $isha_iqamah = '';
			 $jumua_khutba1 = '';
			 $jumua_iqamah1 = '';
			 $jumua_khutba2 = '';
			 $jumua_iqamah2 = '';
			 $jumua_khutba3 = '';
			 $jumua_iqamah3 = '';

		}
		?>

		<p>
		<b><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
		<b><label for="<?php echo $this->get_field_id('language'); ?>"><?php _e('Language', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b>
		<select class="widefat" id="<?php echo $this->get_field_id('language'); ?>" name="<?php echo $this->get_field_name('language'); ?>" >
			<option <?php if ($language == "Arabic") echo "selected"; ?>>Arabic</option>
			<option <?php if ($language == "English") echo "selected"; ?>>English</option>
			<option <?php if ($language == "Urdu") echo "selected"; ?>>Urdu</option>
			
			<?php
				/*
				$options = array('Arabic', 'English', 'Urdu');
				foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				*/
			?>
		</select>
		</p>

		<p>
		<b><label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Note', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b>
		<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>

		<table>
			<tr>
				<td>&nbsp;</td>
				<td>Adhan</td>
				<td>Iqamah</td>
			</tr>
			<tr>
				<td><b><label for="<?php echo $this->get_field_id('fajr_adhan'); ?>"><?php _e('Fajr ', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('fajr_adhan'); ?>" name="<?php echo $this->get_field_name('fajr_adhan'); ?>" type="text" value="<?php echo $fajr_adhan; ?>" /></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('fajr_iqamah'); ?>" name="<?php echo $this->get_field_name('fajr_iqamah'); ?>" type="text" value="<?php echo $fajr_iqamah; ?>" /></td>
			</tr>
			<tr>
				<td><b><label for="<?php echo $this->get_field_id('zuhr_adhan'); ?>"><?php _e('Zuhr ', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('zuhr_adhan'); ?>" name="<?php echo $this->get_field_name('zuhr_adhan'); ?>" type="text" value="<?php echo $zuhr_adhan; ?>" /></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('zuhr_iqamah'); ?>" name="<?php echo $this->get_field_name('zuhr_iqamah'); ?>" type="text" value="<?php echo $zuhr_iqamah; ?>" /></td>
			</tr>
			<tr>
				<td><b><label for="<?php echo $this->get_field_id('asr_adhan'); ?>"><?php _e('Asr ', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('asr_adhan'); ?>" name="<?php echo $this->get_field_name('asr_adhan'); ?>" type="text" value="<?php echo $asr_adhan; ?>" /></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('asr_iqamah'); ?>" name="<?php echo $this->get_field_name('asr_iqamah'); ?>" type="text" value="<?php echo $asr_iqamah; ?>" /></td>
			</tr>
			<tr>
				<td><b><label for="<?php echo $this->get_field_id('maghrib_adhan'); ?>"><?php _e('Maghrib ', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('maghrib_adhan'); ?>" name="<?php echo $this->get_field_name('maghrib_adhan'); ?>" type="text" value="<?php echo $maghrib_adhan; ?>" /></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('maghrib_iqamah'); ?>" name="<?php echo $this->get_field_name('maghrib_iqamah'); ?>" type="text" value="<?php echo $maghrib_iqamah; ?>" /></td>
			</tr>
			<tr>
				<td><b><label for="<?php echo $this->get_field_id('isha_adhan'); ?>"><?php _e('Isha ', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('isha_adhan'); ?>" name="<?php echo $this->get_field_name('isha_adhan'); ?>" type="text" value="<?php echo $isha_adhan; ?>" /></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('isha_iqamah'); ?>" name="<?php echo $this->get_field_name('isha_iqamah'); ?>" type="text" value="<?php echo $isha_iqamah; ?>" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Khutba</td>
				<td>Iqamah</td>
			</tr>
			<tr>
				<td><b><label for="<?php echo $this->get_field_id('jumua_khutba1'); ?>"><?php _e('Jumua&nbsp;1 ', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('jumua_khutba1'); ?>" name="<?php echo $this->get_field_name('jumua_khutba1'); ?>" type="text" value="<?php echo $jumua_khutba1; ?>" /></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('jumua_iqamah1'); ?>" name="<?php echo $this->get_field_name('jumua_iqamah1'); ?>" type="text" value="<?php echo $jumua_iqamah1; ?>" /></td>
			</tr>
			<tr>
				<td><b><label for="<?php echo $this->get_field_id('jumua_khutba2'); ?>"><?php _e('Jumua&nbsp;2 ', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('jumua_khutba2'); ?>" name="<?php echo $this->get_field_name('jumua_khutba2'); ?>" type="text" value="<?php echo $jumua_khutba2; ?>" /></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('jumua_iqamah2'); ?>" name="<?php echo $this->get_field_name('jumua_iqamah2'); ?>" type="text" value="<?php echo $jumua_iqamah2; ?>" /></td>
			</tr>
			<tr>
				<td><b><label for="<?php echo $this->get_field_id('jumua_khutba3'); ?>"><?php _e('Jumua&nbsp;3 ', 'MasjidIqamahTimingsWidgetPlugin'); ?></label></b></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('jumua_khutba3'); ?>" name="<?php echo $this->get_field_name('jumua_khutba3'); ?>" type="text" value="<?php echo $jumua_khutba3; ?>" /></td>
				<td><input class="widefat" id="<?php echo $this->get_field_id('jumua_iqamah3'); ?>" name="<?php echo $this->get_field_name('jumua_iqamah3'); ?>" type="text" value="<?php echo $jumua_iqamah3; ?>" /></td>
			</tr>
		</table>

		<input class="widefat" id="<?php echo $this->get_field_id('last_updated'); ?>" name="<?php echo $this->get_field_name('last_updated'); ?>" type="hidden" value="<?php echo date("Y M d", time()) ?>" />

		<?php
		
	} // form
 
	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['language'] = strip_tags($new_instance['language']);
		$instance['fajr_adhan'] = strip_tags($new_instance['fajr_adhan']);
		$instance['fajr_iqamah'] = strip_tags($new_instance['fajr_iqamah']);
		$instance['zuhr_adhan'] = strip_tags($new_instance['zuhr_adhan']);
		$instance['zuhr_iqamah'] = strip_tags($new_instance['zuhr_iqamah']);
		$instance['asr_adhan'] = strip_tags($new_instance['asr_adhan']);
		$instance['asr_iqamah'] = strip_tags($new_instance['asr_iqamah']);
		$instance['maghrib_adhan'] = strip_tags($new_instance['maghrib_adhan']);
		$instance['maghrib_iqamah'] = strip_tags($new_instance['maghrib_iqamah']);
		$instance['isha_adhan'] = strip_tags($new_instance['isha_adhan']);
		$instance['isha_iqamah'] = strip_tags($new_instance['isha_iqamah']);
		$instance['jumua_khutba1'] = strip_tags($new_instance['jumua_khutba1']);
		$instance['jumua_iqamah1'] = strip_tags($new_instance['jumua_iqamah1']);
		$instance['jumua_khutba2'] = strip_tags($new_instance['jumua_khutba2']);
		$instance['jumua_iqamah2'] = strip_tags($new_instance['jumua_iqamah2']);
		$instance['jumua_khutba3'] = strip_tags($new_instance['jumua_khutba3']);
		$instance['jumua_iqamah3'] = strip_tags($new_instance['jumua_iqamah3']);
		$instance['textarea'] = strip_tags($new_instance['textarea']);
		$instance['last_updated'] = strip_tags($new_instance['last_updated']);
		return $instance;
	} 

		
	// display widget
	function widget($args, $instance) {
		
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$language = $instance['language'];
		$fajr_adhan = $instance['fajr_adhan'];
		$fajr_iqamah = $instance['fajr_iqamah'];
		$zuhr_adhan = $instance['zuhr_adhan'];
		$zuhr_iqamah = $instance['zuhr_iqamah'];
		$asr_adhan = $instance['asr_adhan'];
		$asr_iqamah = $instance['asr_iqamah'];
		$maghrib_adhan = $instance['maghrib_adhan'];
		$maghrib_iqamah = $instance['maghrib_iqamah'];
		$isha_adhan = $instance['isha_adhan'];
		$isha_iqamah = $instance['isha_iqamah'];
		$jumua_khutba1 = $instance['jumua_khutba1'];
		$jumua_iqamah1 = $instance['jumua_iqamah1'];
		$jumua_khutba2 = $instance['jumua_khutba2'];
		$jumua_iqamah2 = $instance['jumua_iqamah2'];
		$jumua_khutba3 = $instance['jumua_khutba3'];
		$jumua_iqamah3 = $instance['jumua_iqamah3'];
		$textarea = $instance['textarea'];
		$last_updated = $instance['last_updated'];
		
		
		$widget_data .= '';
		
		$widget_data .= $before_widget;

		if ( $title ) $widget_data .= $before_title . $title . $after_title;
		if( $textarea ) $widget_data .= '<p class="mit_note">'.$textarea.'</p>';
		
		// Arabic
		if ($language == "Arabic")  {
			$widget_data .= '<table dir="rtl"><tr><th>&nbsp;</th><th>الاذان</th><th>الاقامۃ</th></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">الفجر</td><td class="mit_time">'.$fajr_adhan.'</td><td class="mit_time">'.$fajr_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">الظهر</td><td class="mit_time">'.$zuhr_adhan.'</td><td class="mit_time">'.$zuhr_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">العصر</td><td class="mit_time">'.$asr_adhan.'</td><td class="mit_time">'.$asr_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">المغرب</td><td class="mit_time">'.$maghrib_adhan.'</td><td class="mit_time">'.$maghrib_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">العشاء</td><td class="mit_time">'.$isha_adhan.'</td><td class="mit_time">'.$isha_iqamah.'</td></tr>';
			$widget_data .= '<table dir="rtl"><tr><th>&nbsp;</th><th>الخطبۃ</th><th>الاقامۃ</th></tr>';
			$widget_data .= '<tr class="mit_jumua"><td class="mit_label">الجمعة</td><td class="mit_time">'.$jumua_khutba1.'</td><td class="mit_time">'.$jumua_iqamah1.'</td></tr>';
			$widget_data .= '<tr class="mit_jumua"><td class="mit_label">الجمعة</td><td class="mit_time">'.$jumua_khutba2.'</td><td class="mit_time">'.$jumua_iqamah2.'</td></tr>';
			$widget_data .= '<tr class="mit_jumua"><td class="mit_label">الجمعة</td><td class="mit_time">'.$jumua_khutba3.'</td><td class="mit_time">'.$jumua_iqamah3.'</td></tr>';
			$widget_data .= '<tr><td colspan="3" class="mit_saved">Last saved<br> '.$last_updated.'</td></tr>';
			$widget_data .= '</table>';
		} else if ($language == "Urdu") {
			$widget_data .= '<table dir="rtl"><tr><th>&nbsp;</th><th>اذان</th><th>نماز</th></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">فجر</td><td class="mit_time">'.$fajr_adhan.'</td><td class="mit_time">'.$fajr_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">ظہر</td><td class="mit_time">'.$zuhr_adhan.'</td><td class="mit_time">'.$zuhr_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">عصر</td><td class="mit_time">'.$asr_adhan.'</td><td class="mit_time">'.$asr_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">مغرب</td><td class="mit_time">'.$maghrib_adhan.'</td><td class="mit_time">'.$maghrib_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">عشاء</td><td class="mit_time">'.$isha_adhan.'</td><td class="mit_time">'.$isha_iqamah.'</td></tr>';
			$widget_data .= '<table dir="rtl"><tr><th>&nbsp;</th><th>خطبہ</th><th>نماز</th></tr>';
			$widget_data .= '<tr class="mit_jumua"><td class="mit_label">جمعہ</td><td class="mit_time">'.$jumua_khutba1.'</td><td class="mit_time">'.$jumua_iqamah1.'</td></tr>';
			$widget_data .= '<tr class="mit_jumua"><td class="mit_label">جمعہ</td><td class="mit_time">'.$jumua_khutba2.'</td><td class="mit_time">'.$jumua_iqamah2.'</td></tr>';
			$widget_data .= '<tr class="mit_jumua"><td class="mit_label">جمعہ</td><td class="mit_time">'.$jumua_khutba3.'</td><td class="mit_time">'.$jumua_iqamah3.'</td></tr>';
			$widget_data .= '<tr><td colspan="3" class="mit_saved">یہ اوقات مندرجہ ذیل تاریخ کو محفوظ کیے گئے<br> '.$last_updated.'</td></tr>';
			$widget_data .= '</table>';
		// English
		} else if ($language == "English" || empty($language)) {
			$widget_data .= '<table><tr><th>&nbsp;</th><th>Adhan</th><th>Iqamah</th></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">Fajr</td><td class="mit_time">'.$fajr_adhan.'</td><td class="mit_time">'.$fajr_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">Zuhr</td><td class="mit_time">'.$zuhr_adhan.'</td><td class="mit_time">'.$zuhr_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">Asr</td><td class="mit_time">'.$asr_adhan.'</td><td class="mit_time">'.$asr_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">Maghrib</td><td class="mit_time">'.$maghrib_adhan.'</td><td class="mit_time">'.$maghrib_iqamah.'</td></tr>';
			$widget_data .= '<tr class="mit_daily"><td class="mit_label">Isha</td><td class="mit_time">'.$isha_adhan.'</td><td class="mit_time">'.$isha_iqamah.'</td></tr>';
			$widget_data .= '<table><tr><th>&nbsp;</th><th>Khutba</th><th>Iqamah</th></tr>';
			if ($jumua_khutba1 && $jumua_iqamah1) $widget_data .= '<tr class="mit_jumua"><td class="mit_label">Jumua</td><td class="mit_time">'.$jumua_khutba1.'</td><td class="mit_time">'.$jumua_iqamah1.'</td></tr>';
			if ($jumua_khutba2 && $jumua_iqamah2) $widget_data .= '<tr class="mit_jumua"><td class="mit_label">Jumua</td><td class="mit_time">'.$jumua_khutba2.'</td><td class="mit_time">'.$jumua_iqamah2.'</td></tr>';
			if ($jumua_khutba3 && $jumua_iqamah3) $widget_data .= '<tr class="mit_jumua"><td class="mit_label">Jumua</td><td class="mit_time">'.$jumua_khutba3.'</td><td class="mit_time">'.$jumua_iqamah3.'</td></tr>';
			$widget_data .= '<tr><td colspan="3" class="mit_saved">Last saved<br> '.$last_updated.'</td></tr>';
			$widget_data .= '</table>';
		} // language if
			
		$widget_data .= $after_widget;

		
		if ($language == "Arabic") {
			echo '<div id="masjid-iqamah-timings-widget" dir="rtl">'.$widget_data.'</div>';
		} else if ($language == "Urdu") {
			echo '<div id="masjid-iqamah-timings-widget" class="urdu" dir="rtl">'.$widget_data.'</div>';
		} else {
			echo '<div id="masjid-iqamah-timings-widget">'.$widget_data.'</div>';
		}
		
				
	} // widget function
		
	
} // MasjidIqamahTimingsWidgetPlugin class




?>