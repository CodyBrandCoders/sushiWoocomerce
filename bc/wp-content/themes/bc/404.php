<?php

header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");

get_header(); ?>
 <section class="section">
   <div class="container">
     <div class="row">
       <div class="col-xs-12 text-center">
         <h1>404 Page Not Found</h1>
         <p>The page you are looking for might have been removed, had its name changes, or is temporarily unavailable.</p>
       </div>
     </div>
   </div>
 </section>
<?php get_footer(); ?>
