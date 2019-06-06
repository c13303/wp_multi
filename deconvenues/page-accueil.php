<?php get_header(); ?>
            <h1>CNADA - Centre National d'Archivage des Déconvenues Administratives</h1>
<?php
$categories = get_categories();
foreach ($categories as $category) {
   
    $count = $category->category_count;
    echo '<a href="' . get_category_link($category->term_id) . '">'
            . '<div class="accroche_ hoverable">'
            . '&#128193;' . $category->name . ' <span class="count">('.$count.')</span>'
            . '</div>'
            . '</a>';
}
?>

</div><!-- content -->

<?php get_footer(); ?>

