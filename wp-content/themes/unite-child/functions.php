<?php
function post_add_custom_data($content){
    $id = get_the_ID();
    $ticket_price = get_field('ticket_price', $id);
    if( is_array($ticket_price) )
	{
		$ticket_price = @implode(', ',$ticket_price);
	}
    $release_date = get_field('release_date', $id);
    if( is_array($release_date) )
	{
		$release_date = @implode(', ',$release_date);
	}
    $custom = "<div class=\"taxonimies\">";
    $custom .=get_the_term_list( $id, 'country', 'Countries: ', ', ', ' ' );
    $custom .="</br> ".get_the_term_list( $id, 'genre', 'Genres: ', ', ', ' ' );
    $custom .="</br> Ticket Price: ".$ticket_price;
    $custom .="</br>Release Date: ".$release_date."</div>";
    return $content.$custom;
}
// Add Shortcode
function recent_films_shortcode( $atts , $content = null ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'films' => '5',
		),
		$atts,
		'recent-films'
	);

	// Query
	$the_query = new WP_Query( array ( 'posts_per_page' => $atts['films'],'post_type' =>'films' ) );
	// films
	$output = '<ul>';
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$output .= '<li><a href="'.get_the_permalink( $post->ID ).'">' . get_the_title() . '</a></li>';
	endwhile;
	$output .= '</ul>';
	
	
	// Return code
	return $output;

}
add_shortcode( 'recent-5-films', 'recent_films_shortcode' );
?>