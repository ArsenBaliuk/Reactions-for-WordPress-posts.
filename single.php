//
// Place the 'reactions-section' section in your single.php file in the WordPress loop
//
<?php get_header(); ?>

    <article>
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post();
            $post_id = get_the_ID(); ?>

            <section class="reactions-section">
                <div class="container">
                    <div class="row">

                        <h2 class="title">Reaction to publications</h2>

                        <div class="reactions-section__reactions-block" id="reactions_block">

                            <a href="#" class="reactions-section__reaction reactions-section__reaction_love <?php if($_COOKIE['current_reaction'] == 'love-reactions') echo 'reactions-section__reaction_current'?>" data-id="<?php the_ID(); ?>" data-type="love-reactions">Love Reaction
                                <span class="reactions-section__count"><?php display_post_reactions_numb( get_the_ID(), 'love-reactions' ); ?></span>
                            </a>
                            <a href="#" class="reactions-section__reaction reactions-section__tearful <?php if($_COOKIE['current_reaction'] == 'tearful-reactions') echo 'reactions-section__reaction_current'?>" data-id="<?php the_ID(); ?>" data-type="tearful-reactions">Tearful Reaction
                                <span class="reactions-section__count"><?php display_post_reactions_numb( get_the_ID(), 'tearful-reactions' ); ?></span>
                            </a>
                            <a href="#" class="reactions-section__reaction reactions-section__reaction_surprised <?php if($_COOKIE['current_reaction'] == 'surprised-reactions') echo 'reactions-section__reaction_current'?>" data-id="<?php the_ID(); ?>" data-type="surprised-reactions">Surprised Reaction
                                <span class="reactions-section__count"><?php display_post_reactions_numb( get_the_ID(), 'surprised-reactions' ); ?></span>
                            </a>
                            <a href="#" class="reactions-section__reaction reactions-section__reaction_thoughtful <?php if($_COOKIE['current_reaction'] == 'thoughtful-reactions') echo 'reactions-section__reaction_current'?>" data-id="<?php the_ID(); ?>" data-type="thoughtful-reactions">Thoughtful Reaction
                                <span class="reactions-section__count"><?php display_post_reactions_numb( get_the_ID(), 'thoughtful-reactions' ); ?></span>
                            </a>

                        </div>

                        <style>
                            .reactions-section__reactions-block {
                                width: 100%;
                                display: flex;
                                justify-content: space-around;
                                gap: 40px;
                            }
                            .reactions-section__reaction_current {
                                color: red;
                            }
                        </style>


                    </div>
                </div>
            </section>

            <?php endwhile; ?>
        <?php endif; ?>
    </article>

<?php get_footer(); ?>
