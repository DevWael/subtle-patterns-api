<?php

$main_url           = 'http://localhost/patterns/';
$images_folder_name = 'patterns';
$images_array       = array();

$dir = new DirectoryIterator( dirname( __FILE__ ) . '/patterns' );
if ( $dir ) {
	foreach ( $dir as $fileinfo ) {
		if ( ! $fileinfo->isDot() ) {
			$file_ext                 = pathinfo( $fileinfo->getFilename(), PATHINFO_EXTENSION );
			$file_id                  = basename( $fileinfo->getFilename(), '.' . $file_ext );
			$images_array[ $file_id ] = $main_url . $images_folder_name . '/' . $fileinfo->getFilename();
		}
	}
}'';

if ( $images_array ) {
	if ( isset( $_GET['id'] ) ) {
		if ( $_GET['id'] && array_key_exists( $_GET['id'], $images_array ) ) {
			echo json_encode( $images_array[ $_GET['id'] ] );
		} else {
			http_response_code( 404 );
			echo '404 - No images assigned to the given id';
		}
	} else {
		echo json_encode( $images_array );
	}
} else {
	http_response_code( 404 );
}