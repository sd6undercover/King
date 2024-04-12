<?php
/**
 * Template part for displaying event posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package King
 */

?>

<?php

 $start_date_time = strtotime(get_post_meta($post->ID, 'start_date_time', true));
 $end_date_time = strtotime(get_post_meta($post->ID, 'end_date_time', true));
 $start_date = date('l j F Y', $start_date_time ) ;
 $end_date = date('l j F Y', $end_date_time ) ;
 $start_time = date('g:ia', $start_date_time );
 $end_time = date('g:ia', $end_date_time );
 $all_day_event = get_post_meta($post->ID, 'all_day_event', true);

 $admission = get_post_meta($post->ID, 'event_admission', true);
 $website = get_post_meta($post->ID, 'contact_website', true);
 $contact_name = get_post_meta($post->ID, 'contact_name', true);
 $contact_number = get_post_meta($post->ID, 'contact_telephone', true);
 $facebookevent = get_post_meta($post->ID, 'event_facebook_page', true);
 $location_id = get_post_meta($post->ID, 'event_primary_location', true);

 $location_url = get_the_permalink($location_id);
 $location_address = get_post_meta($location_id, 'location_address_full', true);
 $location_address_short = get_post_meta($location_id, 'location_address_short', true);
 $location_link = '<p>' . '<a href="' . esc_attr($location_url) . '">' . $location_address_short .'</a></p>';

 $group_id = get_post_meta($post->ID, 'event_group', true);
 $group_url = get_the_permalink($group_id);
 $group_name = get_post_meta($group_id, 'group_name', true);
 $group_link = '<p>' . '<a href="' . esc_attr($group_url) . '">' . $group_name .'</a></p>';

 $colour = get_post_meta($post->ID, 'colour', true);

 $current_id = $post->ID;

 if ( is_singular() ) : ?>

        <?php


        if (get_post_meta($post->ID, 'event_cancelled', true)) :

        ?>

        <section class="event-message-bar">
            <div class="wrapper">
                <div class="group">
                    <div class="col-12">
                        <p class="background-dark-red">This event has been cancelled. See details below.</p>
                    </div>
                </div>
            </div>
        </section>

        <?php

        elseif (get_post_meta($post->ID, 'event_updated', true)) :

        ?>

        <section class="event-message-bar">
            <div class="wrapper">
                <div class="group">
                    <div class="col-12">
                        <p class="background-dark-blue">This event has been updated. See details below.</p>
                    </div>
                </div>
            </div>
        </section>

        <?php

        endif;

        ?>

        <section id="event-container">
            <div class="wrapper">
                <div class="grouping">
                    <div class="content-main">
                        <h1><?php echo get_post_meta($post->ID, 'event_title', true); ?></h1>
                        <?php if (!empty($location_address_short) ) : ?>
                            <p><?php echo ( $location_address_short ); ?></p>
                        <?php endif; ?>
                        <?php if (has_post_thumbnail() ) : ?>
                            <div class="event-image">
                                <figure>
                                    <?php echo get_the_post_thumbnail(); ?>
                                </figure>
                            </div>
                        <?php endif; ?>
                        <?php

                            if (get_post_meta($post->ID, 'event_cancelled', true)) :

                        ?>

                            <section class="event-changed-text message-box-red">
                                <div>This event has been cancelled.</div>
                                <?php echo wpautop(get_post_meta($post->ID, 'event_cancelled_additional_text', true)); ?>
                            </section>

                        <?php

                            elseif (get_post_meta($post->ID, 'event_updated', true)) :

                        ?>

                            <section class="event-changed-text message-box-blue">
                                <div>This event has been updated.</div>
                                <?php echo wpautop(get_post_meta($post->ID, 'event_updated_additional_text', true)); ?>
                            </section>

                        <?php

                            endif;

                        ?>

                        <section id="event-description">
                        
                            <h2><?php echo get_post_meta($post->ID, 'event_headline', true); ?></h2>


                            <?php echo wpautop(get_post_meta($post->ID, 'event_description', true)); ?>


                        </section>





                    </div>
                    <aside>
                        <div class="aside-text-box">
                            <h2 class="hidden">Event Details</h2>



                            <?php if (get_post_meta($post->ID, 'start_date_time', true) ) : ?>



                                <div>

                                    <h3>Date</h3>

                                    <p>

                                        <?php 

                                            //Start Date only

                                            if (empty($end_date_time) || $start_date == $end_date) :

                                                echo date('l j F Y', $start_date_time ) ;

                                            else :

                                            //Has End Date different to Start Date

                                                if (date('Y', $start_date_time) == date('Y', $end_date_time)) :

                                                    //Same Year

                                                    if (date('F', $start_date_time) == date('F', $end_date_time)) :

                                                        //Same Month

                                                        echo (date('l j', $start_date_time ) . ' to ' . date('l j F Y', $end_date_time ) );

                                                    else :

                                                        //Different Months

                                                        echo (date('l j F', $start_date_time ) . ' to ' . date('l j F Y', $end_date_time ) );

                                                    endif;

                                                else :

                                                    //Different years

                                                    echo (date('l j F Y', $start_date_time ) . ' to ' . date('l j F Y', $end_date_time ) );

                                                endif;

                                            endif;

                                        ?>

                                    </p>

                                </div>



                                <?php if (!empty($start_time) && ($all_day_event == FALSE)) : ?>



                                    <div>

                                        <h3>Time</h3>

                                        <p>

                                            <?php

                                                if (date('i', $start_date_time) == '00') :

                                                    echo ( 'From ' . date('ga', $start_date_time ));

                                                else : 

                                                    echo ( 'From ' . date('g:ia', $start_date_time ));

                                                endif;

                                                if (!empty($end_date_time)) :

                                                    if (date('i', $end_date_time) == '00') :

                                                        echo ( ' until ' . date('ga', $end_date_time ));

                                                    else : 

                                                        echo ( ' until ' . date('g:ia', $end_date_time ));

                                                    endif;

                                                endif;

                                            ?>

                                        </p>

                                    </div>

                                <?php endif; ?>

                            <?php endif; ?>



                            <?php if (!empty($group_id)) : ?>

                                <div>

                                    <h3>Presented by</h3>

                                    <?php echo $group_link; ?>

                                </div>

                            <?php endif; ?>



                            <div>



                                <?php if (get_post_meta($post->ID, 'online_event', true)) : ?>

                                        <h3>Location</h3>

                                        <p>Online</p>

                                        <?php echo wpautop(get_post_meta($post->ID, 'online_instructions', true)); ?>

                                <?php else:

                                    if (!empty($location_url) ) : ?>

			                            <h3>Location</h3>

                                        <?php echo ( $location_link ); ?>

                                    <?php endif; ?>

                                <?php endif;?>



                            </div>



                            

                            <?php if (!empty($admission)) : ?>

                                <div>

                                    <h3>Admission</h3>

                                    <?php echo wpautop($admission); ?>

                                </div>

                            <?php endif; ?>


                        </div>

                        <div class="event-details background-light-<?php echo $colour; ?>">
                            <h2 class="hidden">Further information</h2>
                            <?php if (!empty($website)) : ?>

                                <div>

                                    <h3>Website</h3>

                                    <p>More details are available from the <a href="<?php echo $website; ?>">organisers website</a></p>

                                </div>

                            <?php elseif (!empty($contact_name)) : ?>

                                <div>

                                    <h3>Contact</h3>

                                    <p>More details are available from <?php echo ($contact_name . ' on ' . $contact_number); ?></p>

                                </div>

                            <?php endif; ?>





                            <?php if (!empty($facebookevent)) : ?>

                                <div>

                                    <h3>Facebook</h3>

                                    <p>Visit the <a href="<?php echo $facebookevent; ?>">Facebook Event</a> page</p>

                                </div>

                            <?php endif; ?>



                            <p class="text-small">We are not responsible for the content of external sites.</p>
                        </div>

                        <div class="event-details background-light-<?php echo $colour; ?>">

                            <div style="line-height: 1.2em;">

                                Event details may be subject to change without notice.

                            </div>
                        </div>

                        <div class="event-share-box">
                            <?php

                            if ( function_exists( 'sharing_display' ) ) {

                                sharing_display( '', true );

                            }

                            if ( class_exists( 'Jetpack_Likes' ) ) {

                                $custom_likes = new Jetpack_Likes;

                                echo $custom_likes->post_likes( '' );

                            }

                            ?>
                        </div>
                        </aside>

                </div>
            </div>
        </section>



        <?php
        if (get_field('is_parent_event')) : 


            
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

                    'key' => 'parent_event',

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

            query_posts(

	            array_merge(

		            //$wp_query->query,

		            $args

	            )

            );

            if ( have_posts() ) : ?>

                <section id="calendar" class="wrapper">



                    <div class="group group-flex">

            

                        <div class="col-12 flex"><h2 style="margin: 0 0 18px 0;">Events</h2></div>

                    <?php

			        // Start the Loop.
			        while ( have_posts() ) : the_post();

				        get_template_part( 'content-calendar-event' );

			        // End the loop.
			        endwhile;

			        ?>
                        



                    </div>



                </section>

                <?php
		    endif;


elseif ( ! empty( get_the_tags($currentID) )) : 

    foreach( get_the_tags($currentID) as $post_tag ) {

  
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
        'key' => 'event_cancelled',
        'value' => TRUE,
        'compare' => '!=',
      )

                ),
                'order' => 'ASC',

                'orderby' => 'meta_value',

                'meta_key' => 'start_date_time',

                'post_type' => 'event',

                'posts_per_page' => -1,

                'tag_id' => $post_tag->term_id,

                'post__not_in' => array($current_id)

            );

            global $wp_query;

            query_posts(

	            array_merge(

		            //$wp_query->query,

		            $args

                    //array('tag' => $post_tag->name)

	            )

            );

            if ( have_posts() ) : ?>

                <section id="promos" class="wrapper">



                    <div class="group group-flex">

            

                        <div class="col-12"><h2 style="font-size: 1.4em; margin: 0 0 18px 0;">Related events</h2></div>

                    <?php

			        // Start the Loop.
			        while ( have_posts() ) : the_post();

				        get_template_part( 'content-featured-event' );

			        // End the loop.
			        endwhile;

			        ?>
                        



                    </div>



                </section>

                <?php
		    endif;
        }

    endif;

?>

<?php else : ?>
    <div class="col-3 flex">
        <article id="post-<?php the_ID(); ?>" <?php post_class('nav-box nav-box-white'); ?>>
            <a href="<?php the_permalink(); ?>">
                
                <div class="nav-box-text">
                    <?php the_title( '<h3>', '</h3>' ); ?>
                    <div class="strap"><?php the_excerpt(); ?></div>
                </div>
            </a>
        </article><!-- #post-<?php the_ID(); ?> -->
    </div>
<?php endif; ?>
