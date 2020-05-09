# php_paginator
A simple class for showing pagination links without loosing parameters on query string

<br><br>

REMEMBER:

<br>

This class does not contains any possibilities for data limitations!
(like posts, products or whatever you want to paginate), it only creates pagination links and shows the pagination links in a nice html markup!


<br><br>
**how to use:**
<br>
   Just include class and use this small lines of code:
<br>

`<?php
 
$total_count = 100; // number of items that should be paginated
<br>
$per_page_count = 10; // number of items that should be displayed on each page
<br><br>
$paginator = new Paginator($total_count, $per_page_count);
<br>
$paginator->showLinks();
 
?>`

<br><br><br>
**requirements:**
<br>
  bootstrap > 4.0
  <br>
  php > 5.6
