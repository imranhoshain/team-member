<?php

function team_member_custom_post()
{

    //Team Member Custom Post Slider
    register_post_type('team-member', array(
        'label' => 'team',
        'labels' => array(
            'name' => 'Team Member',
            'singular_name' => 'team'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-admin-comments',
        'show_ui' => true,
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'excerpt'
        )
    ));
    
}
add_action('init', 'team_member_custom_post');