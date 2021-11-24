<?php




$html = 'https://www.saq.com/fr/produits/vin';

var_dump((parse_url($html)));
// Find all links
// foreach($html->find('.product-item') as $element) 
//        echo $element->href . '<br>';