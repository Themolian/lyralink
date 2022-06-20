<?php
/**
 * The template for the Moves Taxonomy
 */

get_header();

$term = get_queried_object();

$moves_query = new WP_Query(array(
    'post_type' => 'Transitions',
    'tax_query' => array(
        array(
            'taxonomy' => 'moves',
            'field' => 'slug',
            'terms' => $term->slug,
        )
    ),
    'posts_per_page' => -1,
));

?>

	<main id="primary" class="site-main">
        <h1>This is the <?php echo $term->name ?> page</h1>
        <?php if($moves_query->have_posts()) : ?>
            <section class="moves-list">
                <div class="moves-list__inner">
                    <?php while($moves_query->have_posts()) : $moves_query->the_post() ?>
                        <div class="moves-list__move">
                            <div class="move-image">
                                <?php 
                                    $move_image = get_field('image');
                                ?>
                                <?php if(!empty($move_image)) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="move-title">
                                <h3><?php the_title(); ?></h3>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; ?>
	</main><!-- #main -->
<?php
get_footer();
