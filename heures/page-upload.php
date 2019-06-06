<?php
acf_form_head();
get_header();
?>



<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <header class="page-header">
            <h1 class="page-title">Espace Publication</h1>			
        </header>

        <article>
            <div class="entry-content">
                <div class="mypost">
                    <?php
                    if (!is_user_logged_in()) :
                        wp_login_form();
                    else :
                        $heure = get_field('heure', 'user_' . get_current_user_id());

                        if (!$heure) {
                            ?>
                            <p>Vous n'avez pas encore d'heure ! Veuillez configurer votre heure ici : <a href='/wp-admin/profile.php'>(modifier mon profil)</a>. </p>
                            <?php
                        } else {
                            ?>
                            <p>Votre heure est <b><?= $heure; ?></b> <a href='/wp-admin/profile.php'>(modifier)</a>. </p>

                            <p><a href="#upload" class="upme">Cliquer ici pour ajouter vos photos</a>, n'oubliez pas de sauvegarder ensuite. </p>
                            <div class='monform'>
                            <?php
                            acf_form(array(
                                'post_id' => 'new_post',
                                'new_post' => array(
                                    'post_type' => 'photoload',
                                    'post_status' => 'publish'
                                ),
                                'post_title' => false,
                                'submit_value' => 'Sauvegarder les Photos'
                            ));
                            ?>
                            </div>
                            <h3>Infos supplémentaires</h3>
                            <p>Mettre une alarme sur votre téléphone pour prendre la photo à l'heure</p>
                            <p>Garder son appareil photo à date : les photos sont automatiquement organisées en fonction de la date de prise de vue. </p>
                            <p>On peut alors uploader un groupe de photos d'un seul coup</p>
                            <p>Pour rédiger une légende, écrivez dans la case "légende" dans le gestionnaire de média lors de l'upload</p>
                            <p>Pour modifier ou effacer vos photos, <a href="/wp-admin/edit.php">cliquez ici</a>.</p>
                            <script>

                                jQuery(document).ready(function ($) {

                                    // Code goes here
                                    console.log('uploader');
                                    $('.upme').click(function () {
                                        $('.monform').show();
                                        $('.acf-gallery-add').trigger('click');
                                        setTimeout(function () {
                                            $('.media-router .media-menu-item').first().trigger('click');
                                        }, 500);
                                    });





                                });
                            </script>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </article>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php
get_footer();
?>
