<?php 
$location = get_field('location');
if( $location ) {

    // Loop over segments and construct HTML.
    $address = '';
    foreach( array('street_number', 'street_name', 'city', 'state', 'post_code', 'country') as $i => $k ) {
        if( isset( $location[ $k ] ) ) {
            $address .= sprintf( '<span class="segment-%s">%s</span>, ', $k, $location[ $k ] );
        }
    }

    // Trim trailing comma.
    $address = trim( $address, ', ' );

    // Display HTML.
    echo '<p>' . $address . '.</p>';
}