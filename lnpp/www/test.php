<?php
   $host        = "host=db";
   $port        = "port=5432";
   $dbname      = "dbname=nansang";
   $credentials = "user=nansang password=nansang";
   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db){
      echo "Sorry, connect error";
   } else {
      echo "We all know that php is the best programming language in the word";
   }
?>

