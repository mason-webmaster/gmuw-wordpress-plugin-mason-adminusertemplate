<?php

/**
 * Summary: php file which implements customizations related to users
 */

//action to take when new users are created
add_action( 'user_register', 'gmuw_aut_new_user', 10, 1 );
function gmuw_aut_new_user( $user_id ) {

	//if user is mason_user
	if ( in_array( 'mason_user', (array) get_userdata($user_id)->roles ) ) {

		//set up dashboard
		gmuw_reset_dash($user_id);

	}

}
