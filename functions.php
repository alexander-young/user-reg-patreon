<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/main.js', [], '1.0', true);
});

add_action('wp_ajax_nopriv_handle_registration_form', function () {

    $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'favorite_basketball_team',
        'favorite_ice_cream',
        'relationship_status',
        'subscriptions'
    ];

    $required = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    $missing_fields = [];
    foreach ($required as $required_key) {
        if (empty($_POST[$required_key])) {
            $missing_fields[] = ucwords(str_replace('_', ' ', $required_key));
        }
    }

    if (!empty($missing_fields)) {
        $message = '<p>Error!</p>';
        foreach ($missing_fields as $missing_field) {
            $message .= '<strong>' . $missing_field . '</strong> is a required field. Please Fix. <br>';
        }
        wp_send_json_error($message);
    }

    if(username_exists( $_POST['email'] )){
        wp_send_json_error('<p>Error! User already exists with that email. Please use a differnt one!</p>');
    }


    $ready_for_save = [];
    foreach ($fillable as $key) {

        if (is_array($_POST[$key]) && !empty($_POST[$key])) {

            $sanitized_items = [];

            foreach ($_POST[$key] as $item) {
                $sanitized_items[] = sanitize_text_field($item);
            }

            $ready_for_save[$key] = $sanitized_items;

        } elseif (!empty($_POST[$key])) {

            switch($key){
                case('email'):
                    $ready_for_save[$key] = sanitize_email($_POST[$key]);
                    break;
                default:
                    $ready_for_save[$key] = sanitize_text_field($_POST[$key]);
                    break;
            }
             

        }
    }

    $user = wp_insert_user([
        'user_login' => $ready_for_save['email'],
        'user_pass' => $ready_for_save['password'],
        'user_email' => $ready_for_save['email'],
        'first_name' => $ready_for_save['first_name'],
        'last_name' => $ready_for_save['last_name'],
    ]);

    if(is_wp_error( $user )){
        wp_send_json_error($user->get_error_message());
    }

    $creds = [
        'user_login' => $ready_for_save['email'],
        'user_password' => $ready_for_save['password'],
        'remember'      => true
    ];
    
    
    foreach($required as $non_meta){
        unset($ready_for_save[$non_meta]);
    }
    
    foreach ($ready_for_save as $meta_key => $meta_value) {
        update_user_meta($user, $meta_key, $meta_value);
    }
    
    
    wp_signon( $creds, false );

    wp_send_json_success($user);

});
