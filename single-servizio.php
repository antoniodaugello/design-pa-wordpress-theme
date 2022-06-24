<?php
/**
 * Servizio template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */
global $uo_id;

get_header();
?>


    <main>
        <?php
        while ( have_posts() ) :
            the_post();

            $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

            // prefix: _dci_servizio_
            $stato = dci_get_meta("stato");
            $motivo_stato = dci_get_meta("motivo_stato");
            $sottotitolo = dci_get_meta("sottotitolo");
            $descrizione_breve = dci_get_meta("descrizione_breve");
            $destinatari = dci_get_meta("a_chi_e_rivolto");
            $destinatari_intro = dci_get_meta("destinatari_introduzione");
            $destinatari_list = dci_get_meta("destinatari_list");
            $descrizione = dci_get_meta("descrizione_estesa");
            $copertura_geografica = dci_get_meta("copertura_geografica");
            $come_fare = dci_get_meta("come_fare");
            $cosa_serve_intro = dci_get_meta("cosa_serve_introduzione");
            $cosa_serve_list = dci_get_meta("cosa_serve_list");
            $output = dci_get_meta("output");
            $fasi_scadenze = dci_get_meta("fasi_scadenze");
            $costi = dci_get_meta("costi");
            $canale_digitale = dci_get_meta("canale_digitale");
            $canale_fisico_prenotazione = dci_get_meta("canale_fisico_prenotazione");
            $canale_fisico_id = dci_get_meta("canale_fisico");
            $canale_fisico = get_post($canale_fisico_id); 
            $more_info = dci_get_meta("ulteriori_informazioni");
            $condizioni_servizio = dci_get_meta("condizioni_servizio");
            $contatti_ids = dci_get_meta("punti_contatto");     
            $contatti = array();            
            foreach ($contatti_ids as $contatto) {
                $item = get_post($contatto);
                $contatti[] = $item;
            }       
            $uo_id = intval(dci_get_meta("unita_responsabile"));
            $argomenti = get_the_terms($post, 'argomenti');

            ?>
            <div class="container" id="main-container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <div class="cmp-heading pb-3 pb-lg-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h1 class="title-xxxlarge" data-element="service-title">
                                        <?php the_title(); ?>
                                    </h1>
                                    <?php if ( $stato == 'true' ) {?>
                                        <div class="d-flex flex-wrap gap-2 cmp-heading__tag">
                                            <div class="cmp-tag">
                                            <a class="cmp-tag__tag title-xsmall u-main-green" href="#">Servizio attivo</a>
                                            </div>
                                        </div>
                                    <?php } else {?>
                                        <div class="d-flex flex-wrap gap-2 cmp-heading__tag">
                                            <div class="cmp-tag">
                                            <a class="cmp-tag__tag title-xsmall u-main-green" href="#">Servizio non attivo</a>
                                            </div>
                                            <div>MOTIVO: <?php echo $motivo_stato ?></div>
                                        </div>
                                    <?php } ?>
                                    <p class="subtitle-small mb-3">
                                        <?php echo $sottotitolo ?>
                                    </p>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#" aria-label="Richiesta di iscrizione online a: <?php the_title(); ?>" class="btn btn-primary fw-bold">
                                        <span class="">Richiesta di iscrizione online</span>
                                    </button>
                                </div>
                                <div class="col-lg-3 offset-lg-1 mt-5 mt-lg-0">
                                    <?php get_template_part('template-parts/single/actions'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="d-none d-lg-block mt-2"/>
                </div>
            </div>
            <div class="container">
                <div class="row mt-4 mt-lg-80 pb-lg-80 pb-40">
                    <div class="col-12 col-lg-3 mb-4 border-col">
                        <aside class="cmp-navscroll sticky-top" aria-labelledby="accordion-title">
                        <div class="inline-menu">
                            <div class="link-list-wrapper">
                            <ul class="link-list">
                                <li>
                                    <a class="list-item large medium right-icon p-0 text-decoration-none" href="#collapseOne" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" data-focus-mouse="true" aria-label="Apri e chiudi il menù INDICE DELLA PAGINA" title="Apri e chiudi il menù INDICE DELLA PAGINA">
                                        <span class="list-item-title-icon-wrapper pb-10 px-3">
                                        <span id="accordion-title" class="title-xsmall-semi-bold">INDICE DELLA PAGINA</span>
                                        <svg class="icon icon-xs right">
                                            <use href="#it-expand"></use>
                                        </svg>
                                        </span>
                                        <!-- Progress Bar -->
                                        <div class="progress bg-light">
                                        <div class="progress-bar" role="progressbar" aria-label="Progress bar dell'indice della pagina" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </a>
                                    <ul class="link-sublist collapse show" id="collapseOne" data-element="index-link-list">
                                    <?php if ($destinatari || is_array($destinatari_list)) { ?>
                                        <li>
                                            <a class="list-item" href="#who-needs" aria-label="Vai alla sezione A chi è rivolto" title="Vai alla sezione A chi è rivolto"
                                            ><span class="title-medium">A chi è rivolto</span></a
                                            >
                                        </li>
                                        <?php } ?>
                                        <?php if ( $descrizione ) { ?>
                                            <li>
                                                <a class="list-item" href="#description" aria-label="Vai alla sezione Descrizione" title="Vai alla sezione Descrizione">
                                                <span class="title-medium">Descrizione</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $copertura_geografica ) { ?>
                                            <li>
                                                <a class="list-item" href="#art-par-copertura_geografica"
                                                ><span>Copertura geografica</span></a
                                                >
                                            </li>
                                        <?php } ?>
                                        <?php if ( $come_fare ) { ?>
                                            <li>
                                            <a class="list-item" href="#how-to" aria-label="Vai alla sezione Come fare" title="Vai alla sezione Come fare">
                                                <span class="title-medium">Come fare</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( is_array($cosa_serve_list) ) { ?>
                                            <li>
                                            <a class="list-item" href="#needed" aria-label="Vai alla sezione Cosa serve" title="Vai alla sezione Cosa serve">
                                                <span class="title-medium">Cosa serve</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $output ) { ?>
                                            <li>
                                            <a class="list-item" href="#obtain" aria-label="Vai alla sezione Cosa si ottiene" title="Vai alla sezione Cosa si ottiene">
                                                <span class="title-medium">Cosa si ottiene</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( is_array($fasi_scadenze) ) { ?>
                                            <li>
                                            <a class="list-item" href="#deadlines" aria-label="Vai alla sezione Tempi e scadenze" title="Vai alla sezione Tempi e scadenze">
                                                <span class="title-medium">Tempi e scadenze</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $costi ) { ?>
                                            <li>
                                            <a class="list-item" href="#costs" aria-label="Vai alla sezione Quanto costa" title="Vai alla sezione Quanto costa">
                                                <span class="title-medium">Quanto costa</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $canale_digitale || $canale_fisico || $canale_fisico_prenotazione ) { ?>
                                            <li>
                                            <a class="list-item" href="#submit-request" aria-label="Vai alla sezione Presenta la domanda" title="Vai alla sezione Presenta la domanda">
                                                <span class="title-medium">Presenta la domanda</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $more_info ) { ?>
                                            <li>
                                            <a class="list-item" href="#more-info" aria-label="Vai alla sezione Ulteriori informazioni" title="Vai alla sezione Ulteriori informazioni">
                                                <span class="title-medium">Ulteriori informazioni</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </aside>      
                    </div>
                    <div class="col-12 col-lg-8 offset-lg-1">
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="who-needs">A chi è rivolto</h2>
                            <p class="lora">
                                <?php echo $destinatari_intro ?>
                                <ul class="list-wrapper lora">
                                    <?php foreach ($destinatari_list as $destinatario) { ?>
                                        <li class="list-item"><span><?php echo $destinatario ?></span</li>
                                    <?php } ?>
                                </ul>
                            </p>
                        </section>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="description">Descrizione</h2>
                            <p class="text-paragraph lora"><?php echo $descrizione ?></p>
                        </section>
                        <?php #if ( $copertura_geografica ) { }?>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="how-to">Come fare</h2>
                            <p class="text-paragraph lora"> 
                                <?php echo $come_fare ?>
                            </p>
                        </section>
                        <section class="mb-30 has-bg-grey p-3">
                            <h2 class="title-xxlarge mb-3" id="needed">Cosa serve</h2>
                            <p class="text-paragraph lora fw-semibold mb-0">
                                <?php echo $cosa_serve_intro ?>
                            </p>
                            <ul class="link-list lora">
                                <?php foreach ($cosa_serve_list as $cosa_serve_item) { ?>
                                    <li class="list-item"><span><?php echo $cosa_serve_item ?></span></li>
                                <?php } ?>
                            </ul>
                        </section>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="obtain">Cosa si ottiene</h2>
                            <p class="text-paragraph lora"><?php echo $output ?></p>
                        </section>
                        <section class="mb-30">
                            <div class="cmp-timeline">
                                <h2 class="title-xxlarge mb-3" id="deadlines">Tempi e scadenze</h2>
                                <p class="text-paragraph mb-3 lora">Le graduatorie verranno aggiornate ogni mese con nuove assegnazioni e trasferimenti in base ai posti disponibili.</p>
                                <div class="calendar-vertical mb-3">
                                    <?php foreach ($fasi_scadenze as $fase) {                                         
                                        $arrdata =  explode("-", $fase["data_fase"]);
                                        $monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10)); // March
                                        ?>
                                        <div class="calendar-date">
                                            <div class="calendar-date-day">
                                                <small><?php echo $arrdata[2]; ?></small>
                                                <span class="title-xxlarge-regular"><?php echo $arrdata[0];; ?></span>
                                                <small><?php echo $monthName; ?></small>
                                            </div>
                                            <div class="calendar-date-description rounded">
                                                <div class="calendar-date-description-content">
                                                <h3 class="text-purplelight title-medium-2 mb-0">
                                                    <?php echo $fase["titolo_fase"]; ?>
                                                </h3>
                                                </div>
                                            </div> 
                                        </div>
                                    <?php } ?>                            
                                </div>
                            </div>
                        </section>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="costs">Quanto costa</h2>
                            <p class="text-paragraph lora"><?php echo $costi ?></p>
                            <div class="cmp-icon-link">
                                <a class="list-item icon-left d-inline-block" href="#" aria-label="Scarica Tabella rette in base al reddito " title="Scarica Tabella rette in base al reddito ">
                                <span class="list-item-title-icon-wrapper">
                                    <svg class="icon icon-primary icon-sm me-1">
                                    <use href="#it-clip"></use>
                                    </svg>
                                    <span class="list-item t-primary">Tabella rette in base al reddito </span>
                                </span>
                                </a>
                            </div>
                        </section>
                        <section class="mb-30 has-bg-grey p-4">
                            <h2 class="title-xxlarge mb-3" id="submit-request">Dove presentare la domanda</h2>
                            <p class="text-paragraph lora mb-4">Puoi presentare la domanda di iscrizione online, attraverso il servizio
                                digitale Invio domanda di iscrizione, oppure, su appuntamento, presso gli uffici Asili nido.</p>
                    
                            <button type="button" aria-label="Vai alla pagina richiedi iscrizione online alla Scuola dell'infanzia " class="btn btn-primary mobile-full mb-4">
                                <span>Richiesta di iscrizione online</span>
                            </button>
                            <p class="text-paragraph lora mb-4">Uffici dove presentare la domanda su appuntamento</p>
                            <p class="text-paragraph t-primary mb-4">
                                <a href="#" aria-label="Vai a Pranota appuntamento presso Ufficio via C.Benso Conte di Cavour" title="Vai a Pranota appuntamento presso Ufficio via C.Benso Conte di Cavour">Ufficio via C. Benso Conte di Cavour [prenota]</a>
                            </p>
                            <p class="text-paragraph t-primary mb-0">
                                <a href="#" aria-label="Vai a Pranota appuntamento presso Ufficio largo Michelangelo Buonarroti" title="Vai a Pranota appuntamento presso Ufficio largo Michelangelo Buonarroti">Ufficio largo Michelangelo Buonarroti [prenota]</a>
                            </p>
                        </section>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="more-info">Ulteriori informazioni</h2>
                            <h3 class="mb-3 subtitle-medium" id="more-info">Graduatorie di accesso</h3>
                            <p class="text-paragraph lora">
                                <?php echo $more_info ?>
                            </p>
                        </section>
                        <section class="it-page-section">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h6><small class="fw-semibold">Questa pagina è gestita da</small></h6>
                                    <div class="card-wrapper rounded h-auto mt-10">
                                        <?php 
                                            $with_border = true;
                                            get_template_part("template-parts/unita-organizzativa/card"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h6><small>Argomenti:</small></h6>
                                    <?php foreach ( $argomenti as $item ) { ?>
                                        <a 
                                        class="chip-label text-white" 
                                        href="<?php echo get_term_link($item); ?>" 
                                        title="<?php _e("Vai all'argomento", "design_comuni_italia"); ?>: <?php echo $item->name; ?>"
                                        aria-label="<?php _e("Vai all'argomento", "design_comuni_italia"); ?>: <?php echo $item->name; ?>"
                                        >
                                            <div class="chip chip-simple bg-success">
                                                <span class="chip-label text-white"><?php echo $item->name; ?></span>
                                            </div>                
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <?php get_template_part("template-parts/common/valuta-servizio"); ?>
        <?php get_template_part('template-parts/single/more-posts'); ?>
        <?php get_template_part("template-parts/common/assistenza-contatti"); ?>

        <?php
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();
