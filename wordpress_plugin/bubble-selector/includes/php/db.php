<?php 
function saveToDb() {
  global $wpdb;
  
}

function getFromDB($query) {
  global $wpdb;

  $results = $wpdb->get_results($query); // Query to fetch data from database table and storing in $results
  return $results;
}

?>