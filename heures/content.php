<?php

/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
/* translators: %s: Name of current post */
$data = get_field('photo');
//  echo '<pre>'; var_dump($data); echo '</pre>';
$thumb = $data['sizes']['thumbnail'];
echo '<img src="' . $thumb . '" style="width:200px; height:200px; display:inline-block;" alt="' . get_the_date() . '" />';



