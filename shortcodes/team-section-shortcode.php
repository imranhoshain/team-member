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

//Custom Taxonomy OR Catagory Function
function member_type_category(){
    $team_categories = get_terms('team_cat'); //Enter category Name
    $team_category_options = array('' => esc_html__('All Catagory', 'team-member'));
    if($team_categories){
        foreach ($team_categories as $team_category) {
            $team_category_options[$team_category->term_id] = $team_category->name;
        }
    }
    return $team_category_options;
}

//Team Section ShortCode
function team_member_shortcode($atts)
{
    ob_start();
    extract(shortcode_atts(array(        
        'id' => '',        
        'team_member_image' => '',               
        'team_member_name' => '',               
        'team_member_position' => '',
        'team_member_bio' => '',
        'show_button' => '',       
        'count' => '' 

    ), $atts));
    
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

     if (!empty($category)) {
        $arg = array(
            'post_type' => 'team-member',
            'posts_per_page' => $count,
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'team_cat', //Enter Register Taxonomy
                    'field' => 'term_id', //Enter your term name
                    'terms' => $category
                )
            )
        );
    } else {
        $arg = array(
            'post_type' => 'team-member',
            'posts_per_page' => $count,
            'paged' => $paged
        );
    }
    ?>
   <div class="orbit-team-member">
       <div class="all-team-member">
           <?php
            $get_post = new WP_Query($arg);     
                while ($get_post->have_posts()):
                    $get_post->the_post();
                    $post_id = get_the_ID();
                    $bio = get_the_content();          
                        if($team_member_position == 'left') {?> <div class="team-image-left"> <?php } else{ ?> <div class="single-team"> <? } ?>
                            <a href="<?php the_permalink();?>">
                        <div class="image-box-wrapper">
                           <figure class="team-img image-box-img">
                                <?php echo the_post_thumbnail( 'large' ); ?>
                            </figure>
                        </div>
                        </a>
                        <div class="team-detail image-box-content">
                            <a href="<?php the_permalink();?>">
                            <h4 class="team-member-name"><?php echo the_title(); ?></h4></a>
                            <p class="team-member-position"><?php echo the_excerpt(); ?></p>
                            <p class="team-member-bio"><?php echo substr($bio, 0, 100); ?></p>
                        </div>
                    </div>
                    <?php 
                endwhile;      
                if($show_button == 'yes') {?>
                </div>
                <div class="see-all-member"> 
                    <a href="<?php echo get_post_type_archive_link( 'team-member' ); ?>">See All</a>
                    <?php } else{
                        echo "";
                    }?>
        </div>
    </div>
<?php    
    wp_reset_query();
    return ob_get_clean();  
    
}
    add_shortcode('team_members', 'team_member_shortcode');
?>