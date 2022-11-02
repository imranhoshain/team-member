<?php
//Custom Taxonomy OR Catagory
function team_member_taxonomy() {
    register_taxonomy(
        'team_cat',  
        'team-member', //Your Post type here                 
        array(
            'hierarchical'          => true,
            'label'                 => 'Member Type',  
            'query_var'             => true,
            'show_admin_column'     => true,
            'rewrite'               => array(
                'slug'              => 'member_type', 
                'with_front'    => true 
                )
            )
    );
}
add_action( 'init', 'team_member_taxonomy');
//Team Section ShortCode
function team_member_shortcode($atts)
{
    extract(shortcode_atts(array(        
        'id' => '',        
        'team_member_image' => '',               
        'team_member_name' => '',               
        'team_member_position' => '',
        'count' => '' 

    ), $atts));    
 ?>   

    <div class="single-team">
        <div class="image-box-wrapper">
           <figure class="team-img image-box-img">
                <img src="<?php echo $team_member_image['url']?>" alt="">                
                </div>
            </figure>
        </div>
        <div class="team-detail image-box-content">
            <h4 class="image-box-title">sdfsdf<?php echo $team_member_name ?></h4>
            <span class="image-box-description"><?php echo $team_member_position ?></span>
        </div>
    </div>
<?php
}
    add_shortcode('team_member', 'team_member_shortcode');
?>