<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <?php
            while (have_posts()) : the_post();
            ?>
                <article class="blog-post">
                    <h1 class="mb-3"><?php the_title(); ?></h1>
                    <div class="post-meta text-muted mb-4">
                        <span>By <?php the_author(); ?></span> | 
                        <span><?php echo get_the_date(); ?></span>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail mb-4">
                            <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php
            endwhile;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>