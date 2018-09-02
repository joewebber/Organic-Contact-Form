<?php

/**
 * The submissions CSV export
 *
 * This file is used to output the export CSV to the browser
 *
 * @link       http://joewebber.co.uk
 * @since      1.0.0
 *
 * @package    Organic_Contact_Form
 * @subpackage Organic_Contact_Form/admin/partials
 */
?>

<?php
    
    // Start the output buffering
    ob_start();
    
    // Set the filename
    $filename = $this->parent->plugin_name . '_export-' . time() . '.csv';
    
    // Add the created and URL fields to the header row
    $header_row = array(
        'Created',
        'URL'
    );

    // Open the PHP output for writing
    $fh = fopen( 'php://output', 'w' );

    // Output the padding characters for the CSV
    fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );

    // Set the cache control header
    header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );

    // Set the content description header
    header( 'Content-Description: File Transfer' );

    // Set the content type header
    header( 'Content-type: text/csv' );

    // Set the content disposition header
    header( "Content-Disposition: attachment; filename={$filename}" );

    // Set the expires header
    header( 'Expires: 0' );

    // Set the pragma header
    header( 'Pragma: public' );

    // Add the header row to the CSV
    fputcsv( $fh, $header_row );

    // Loop through the submissions
    foreach ( $submissions as $submission ) {

        // Add the submission data to the CSV
        fputcsv( $fh, $submission );

    }

    // Close the file handler
    fclose( $fh );
    
    // Flush the output buffer
    ob_end_flush();
    
    // Kill the script
    die();