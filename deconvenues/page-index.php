<?php get_header(); ?>
<h1>Organismes</h1>
<?php
$terms = get_terms(array(
    'taxonomy' => 'organismes',
    'orderby' => 'count',
    'order' => 'desc',
    'hide_empty' => false,
        ));
foreach ($terms as $term) {
    ?> <br/><a href="<?php echo get_term_link($term); ?>"><?= ucfirst($term->name); ?></a> (<?= $term->count; ?>) <?php
}
?>

</div><!-- content -->

<?php get_footer(); ?>

