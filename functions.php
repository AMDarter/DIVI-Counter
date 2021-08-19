add_action('init', function(){

$ad_default_circle_counter_data = array(
    'date'  => 'April 15, 2022 11:59 PM',
    'title' => 'Days Until the Tax Deadline'
);

update_option('ad_counter_deadline', $ad_default_circle_counter_data);

function ad_days_remaining(){
    
    $ad_counter_deadline = get_option('ad_counter_deadline');

    if( empty($ad_counter_deadline['date']) ){

        return 'error';

    }

    $date = strtotime($ad_counter_deadline['date']);
    // $date = strtotime("April 15, 2022 11:59 PM");
    $remaining = $date - time();
    // $remaining is the number of seconds remaining. Divide that number to get the number of days, hours, minutes, etc.

    return floor($remaining / 86400);
    
}

function ad_counter_title(){

    $ad_counter_deadline = get_option('ad_counter_deadline');
    
    if( empty( $ad_counter_deadline['title'] ) ){
    
        return 'error';

    }

    return $ad_counter_deadline['title'];

}

function ad_add_counter_shortcode() {

    if( ad_days_remaining() == 'error' || ad_counter_title() == 'error' ){
    
        return do_shortcode('An error occurred.');
    
    }

    return do_shortcode(
        '[et_pb_circle_counter admin_label="Circle Counter" title="'. ad_counter_title() . '" percent_sign="off" title_level="h2" title_font_size="30px" number="'. ad_days_remaining() . '" background_layout="light" bar_bg_color="#2ea3f2" disabled="off"] [/et_pb_circle_counter]'
    );

}
add_shortcode('ad_goal_progress_counter', 'ad_add_counter_shortcode');

});
