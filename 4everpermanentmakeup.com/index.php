<?php get_header(); ?>

    <?php get_template_part('sections/header_three'); ?>

    <!-- BLOG -->
    <div class="wrap">
        <div class="container">
            <div class="row">

                <?php
                $blog_title = ot_get_option('blog_title');
                $blog_desc = ot_get_option('blog_desc');
                if( $blog_title || $blog_desc ) :
                    ?>
                    <div class="span12 description">
                        <?php
                        if( !empty($blog_title) )
                        {
                            echo '<div class="title"><h2>'.$blog_title.'</h2></div>';
                        }
                        if( !empty($blog_desc) )
                        {
                            echo '<p>'.$blog_desc.'</p>';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class('span12 post'); ?>">
                        <?php get_template_part('sections/post_formats'); ?>
                        <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <p class="post_meta">By <?php the_author_posts_link() ?> / <span><?php the_time('F j, Y'); ?></span> / <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> / <?php the_category(', '); ?></p>
                        <?php echo the_excerpt(); ?>
                        <p class="tags"><?php if (the_tags('', ', ', ' ')); ?></p>
                    </div>
                <?php endwhile; else: ?>
                    <div class="no-results">
                        <p><strong>No Results Found.</strong></p>
                    </div>
                <?php endif; ?>

                <div class="span12 paggination2">
                    <span class="prev bttn"><?php previous_posts_link('&laquo; Previous Entries') ?></span>
                    <span class="next bttn"><?php next_posts_link('Next Entries &raquo;','') ?></span>
                </div>

	        </div>
       </div>
    </div>

<?php get_footer(); ?>