<?php get_header(); ?>
<main>
    <section class="first-section container">
    <?php
        while ( have_posts() ) : the_post();
        the_content();
        endwhile;
    ?>  
    </section>
</main>
<?php get_footer(); ?>