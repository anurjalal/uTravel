<?php
  //cappa database technologies
  // establish database connection
  //
  $conn = mysql_connect( 'localhost', 'root', 'root' ) or die( mysql_error( ) );
  mysql_select_db( 'k6067927_webe_retail', $conn ) or die( mysql_error( $conn ) );
  //
  // execute sql query
  //
  $query = sprintf( 'SELECT id_brg,stock_brg FROM MSTBRG' );
  $result = mysql_query( $query, $conn ) or die( mysql_error( $conn ) );
  //
  // send response headers to the browser
  // following headers instruct the browser to treat the data as a csv file called export.csv
  //
  header( 'Content-Type: text/csv' );
  header( 'Content-Disposition: attachment;filename=export.csv' );
  //
  // output header row (if atleast one row exists)
  //
  $row = mysql_fetch_assoc( $result );
  if ( $row )
  {
    echocsv( array_keys( $row ) );
  }
  //
  // output data rows (if atleast one row exists)
  //
  while ( $row )
  {
    echocsv( $row );
    $row = mysql_fetch_assoc( $result );
  }
  
  // echocsv function
  
  
  function echocsv( $fields )
  {
    $separator = '';
    foreach ( $fields as $field )
    {
      if ( preg_match( '/\\r|\\n|,|"/', $field ) )
      {
        $field = '"' . str_replace( '"', '""', $field ) . '"';
      }
      echo $separator . $field;
      $separator = ',';
    }
    echo "\r\n";
  }
?>