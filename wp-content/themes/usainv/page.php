<?php

get_header();

?>

<section id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();

                ?>

                <h1 class="page-title"><?php the_title(); ?></h1>

                <?php the_content(); ?>

                <?php

            endwhile;
            ?>
        </div>
    </main>
</section>


<?php

get_footer();
