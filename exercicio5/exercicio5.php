<?php 

$filexml='exemplo.xml';

if (file_exists($filexml)) 
{
  $xml = simplexml_load_file($filexml);
  $f = fopen('test.csv', 'w');
  xmlParaCSV($xml, $f);
  fclose($f);
  echo "Arquivo convertido com sucesso!";
}

function xmlParaCSV($xml,$f)
{
  foreach ($xml->children() as $item) {
    $hasChild = (count($item->children()) > 0)?true:false;
    if(!$hasChild){
       $put_arr = array($item->getName(),$item); 
       fputcsv($f, $put_arr ,',','"');
    }else{
     xmlParaCSV($item, $f);
    }
  }
}
