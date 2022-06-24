<?php
global $the_query, $load_posts;

    $max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 3;
    $load_posts = 3;
    $args = array(
        's' => $_GET['search'],
        'posts_per_page' => $max_posts,
        'post_type'      => 'notizia',
        'orderby'        => 'post_title',
        'order'          => 'ASC'
     );
     $the_query = new WP_Query( $args );

     $posts = $the_query->posts;
?>


<div class="bg-grey-card py-5">
    <form role="search" id="search-form" method="get" class="search-form">
    <button type="submit" class="d-none"></button>
        <div class="container">
            <h2 class="title-xxlarge mb-4">
                Esplora tutte le novità
            </h2>
            <div>
                <div class="cmp-input-search">
                    <div class="form-group autocomplete-wrapper mb-0">
                        <label for="autocomplete-two" class="visually-hidden"
                        >Cerca per parola chiave</label
                        >
                        <input
                        type="search"
                        class="autocomplete"
                        placeholder="Cerca per parola chiave"
                        id="autocomplete-two"
                        name="search"
                        value="<?php echo $_GET['search']; ?>"
                        data-bs-autocomplete="[]"
                        />
                        <span class="autocomplete-icon" aria-hidden="true"
                        ><svg
                            class="icon icon-sm icon-primary"
                            role="img"
                            aria-labelledby="autocomplete-label"
                        >
                            <use
                            href="#it-search"
                            ></use></svg></span>
                        <p
                        id="autocomplete-label"
                        class="u-grey-light text-paragraph-card mt-2 mb-30 mt-lg-3 mb-lg-40"
                        >
                        <?php echo $the_query->found_posts; ?> notizie trovate in ordine alfabetico
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <?php get_template_part('template-parts/novita/cards-list');?>
            </div>
            <?php get_template_part("template-parts/search/more-results"); ?>
        </div>
    </form>
</div>