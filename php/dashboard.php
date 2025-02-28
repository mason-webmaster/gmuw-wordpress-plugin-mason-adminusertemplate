<?php

/**
 * Summary: php file which implements customizations related to the dashboard
 */


//add new user row action to reset a user's dashboard
add_filter('user_row_actions', 'gmuw_aut_admin_user_reset_dash_link', 10, 2);
function gmuw_aut_admin_user_reset_dash_link($actions, $user_object) {

    // Get plugin options
    $gmuw_aut_options = get_option('gmuw_aut_options');

    //is this user the template user?
    if ($gmuw_aut_options['template_user_id']==$user_object->ID) {
        //this is the template user
        $actions['reset_dash'] = '<strike><span style="cursor: help;" title="You can not reset the dashboard for this user. This is the template user.">Reset dashboard</span></strike>';
    } else {
        //this is not the template user, provide reset dash link
        $actions['reset_dash'] = '<a href="' . admin_url( "admin.php?page=gmuw_aut&amp;action=reset_dash&amp;user=$user_object->ID") . '" onclick="return confirm(\'Are you sure you want to reset the user dashboard?\')">Reset dashboard</a>';
    }

    //return actions array
    return $actions;

}

//function to reset a users dashboard to match that of a template user
function gmuw_reset_dash($user_id) {

    //get template user ID from plugin settings
    $template_user_id=get_option('gmuw_aut_options')['template_user_id'];

    //set dashboard configuration related user meta records for the target user based on the template user's configuration
    update_user_meta(
        $user_id, 
        'metaboxhidden_dashboard', 
        get_user_meta($template_user_id, 'metaboxhidden_dashboard', true)
    );
    update_user_meta(
        $user_id, 
        'meta-box-order_dashboard', 
        get_user_meta($template_user_id, 'meta-box-order_dashboard', true)
    );

    //output
    echo '<div class="notice notice-success is-dismissible">';
    echo '<p>User dashboard reset for user ' . get_userdata($user_id)->user_login . '</p>';
    echo '<p>Return to <a href="'.admin_url('users.php').'">users list</a></p>';
    echo '</div>';

}
