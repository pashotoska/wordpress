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
?>