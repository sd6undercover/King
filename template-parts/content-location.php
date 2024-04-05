<?php
/**
 * Template part for displaying location posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package King
 */

?>


<?php
    $location_image = get_field('location_image');
    $colour = get_field('colour');
    $website = get_post_meta($post->ID, 'location_website', true);
    $address = get_field('location_address_full');

    if ( is_single() ) :
?>

        <section id="event-container" class="location-container">
            <div class="wrapper">
                <div class="group">
                    <div class="col-8">
                        <div class="location-main">
                            <h1><?php echo get_post_meta($post->ID, 'location_name', true); ?></h1>

                            <p><?php echo get_post_meta($post->ID, 'location_short_description', true); ?></p>
                            <?php $size = 'hall-regular';
                                if (!empty($location_image) ) : ?>
                                <div class="event-image">
                                    <figure>
                                        <?php echo wp_get_attachment_image( $location_image, $size ); ?>
                                    </figure>
                                </div>
                            <?php endif; ?>
                            <section id="event-description">
                                <h2><?php echo get_post_meta($post->ID, 'location_highlight_description', true); ?></h2>
                                <?php echo wpautop(get_post_meta($post->ID, 'location_description', true)); ?>
                            </section>
                        </div>
                    </div>       
                    <div class="col-4">
                        <div class="event-details background-light-<?php echo $colour; ?>">
                            <h2 class="hidden">Location Details</h2>
                            <?php if( (!empty($address)) ): ?>
	                            <h3>Address</h3>
	                            <p><?php echo str_replace(',', ',<br>', $address); ?></p>
                            <?php endif; ?>
                            <?php if( get_field('location_opening_times') ): ?>
	                            <h3>Opening Times</h3>
	                            <p><?php the_field('location_opening_times'); ?></p>
                            <?php endif; ?>
                            <?php if( get_field('location_admission') ): ?>
	                            <h3>Admission</h3>
	                            <p><?php the_field('location_admission'); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="event-details background-light-<?php echo $colour; ?>">
                            <h2 class="hidden">Further information</h2>
                            <h3>Visit <?php echo get_post_meta($post->ID, 'group_name', true); ?> online</h3>
                            <?php if (!empty($website)) : ?>
                                <p>Website: <a href="<?php echo $website; ?>"><?php echo $website; ?></a></p>
                            <?php endif; ?>
                            <p class="text-small">We are not responsible for the content of external sites.</p>
                        </div>
                        <?php if( has_term('active-alton', 'locationtype') ): ?>
                            <p><a href="/active-alton/"><img src="<?php echo esc_url( get_template_directory_uri() );?>/images/active-alton-logo-sm.jpg" alt="Part of Active Alton" style="width: 100%; height: auto;"/></a></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </section>



		            <?php
wp_reset_query();
$current_id = $post->ID;
$args = array(
    'meta_query' => array(
        'relation' => 'AND',
        array(
        'relation' => 'OR',
            array(
            'key' => 'start_date_time',
            'value' => date('Ymd'),
            'type' => 'date',
            'compare' => '>=',
            ),
            array(
            'key' => 'end_date_time',
            'value' => date('Ymd'),
            'type' => 'date',
            'compare' => '>=',
            )
        ),
      array(
        'key' => 'event_primary_location',
        'value' => $current_id,
        'compare' => '=',
      )
    ),
    'order' => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => 'start_date_time',
    'post_type' => 'event',
    'posts_per_page' => -1
);

global $wp_query;
query_posts($args);
    if ( have_posts() ) : ?>
        <section id="calendar" class="wrapper">
            <div class="group group-flex">
                <div class="col-12">
                    <h2 style="margin: 18px 0;">Upcoming Events at <?php echo get_post_meta($post->ID, 'location_name', true); ?></h2>
                </div>
                <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content-calendar-event' );
                    endwhile;
                ?>
            </div>
		</section>
    <?php endif;

wp_reset_query();

$current_id = $post->ID;

$args = array(

    'meta_query' => 

      array(

        'key' => 'group_location',

        'value' => '"'. $current_id .'"',

        'compare' => 'LIKE',  

        ),

    'order' => 'ASC',

    'orderby' => 'meta_value',

    'meta_key' => 'group_name',

    'post_type' => 'group',

    'posts_per_page' => -1

);

global $wp_query;

query_posts($args);

                    if ( have_posts() ) : 

                        ?>

        <section id="promos" class="wrapper">
            <div class="group">
                <div class="col-12">
                    <h2 style="font-size: 32px; margin: 20px 0 20px 0;">Groups holding meetings at <?php echo get_post_meta($post->ID, 'location_name', true); ?></h2>
                </div>


			        <?php
			            // Start the Loop.
			            while ( have_posts() ) : the_post();

				            get_template_part( 'content-group-promo' );
                            //echo '<a href="'.get_permalink().'">'.get_the_title().'</a><br>';

			            // End the loop.
			            endwhile;
		            ?>  
            </div>
        </section>




			        <?php
		                endif;
		            ?>   


<?php
    else :

?>

        <article class="lp-entry">

            <a href="<?php the_permalink(); ?>" title="<?php echo get_post_meta($post->ID, 'location_name', true); ?>">

                <?php

                    $location_image = get_field('location_image');

                    $size = 'hall-thumb';

                    if (!empty($location_image) ) :  ?>

                    <div class="lp-entry-img">

                    <?php echo wp_get_attachment_image( $location_image, $size );?>

                    </div>

                <?php 

                    endif;

                ?> 

                <h2><?php echo get_post_meta($post->ID, 'location_name', true); ?></h2>

                <p><?php echo get_post_meta($post->ID, 'location_short_description', true); ?></p>

                <p><?php echo get_post_meta($post->ID, 'location_highlight_description', true); ?></p>

            </a>

        </article>

<?php
    endif;
?>
