<?php 

require 'functions.php';

$site="https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_name";
$html = curl($site);



$idom = new DOMDocument();
@$idom->loadHTML($html);
$ixpath = new DOMXPath($idom);

$ids = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[1]/tbody/tr/td[1]');
$imgs = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[1]/tbody/tr/td[2]/a/img');
$names = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[1]/tbody/tr/td[3]/a');
$ability1 = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[1]/tbody/tr/td[4]/a/span');
$ability2 = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[1]/tbody/tr/td[5]/a/span');

$data=array();

for($i=0;$i<$ids->length;$i++){
    $ele=array();
    $ab = array();
    $ele['id']=trim($ids[$i]->textContent);
    $ele['name']=trim($names[$i]->textContent);
    $ele['img']=trim("https:".$imgs[$i]->getAttribute('src'));
    $ab['ability1']=trim($ability1[$i]->textContent);
    if($ability2[$i]!= null)
        $ab['ability2']=trim($ability2[$i]->textContent);
    $ele['abilities'] = $ab;
    array_push($data,$ele);
}
$array['pokemons']=$data;

header('Content-Type: application/json; charset=utf-8');
echo json_encode($array);

/*
$ids = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[1]/tbody/tr/td[1]');
$data=array();

foreach ($ids as $id) {
    $ele=array();
    $ele['code']=trim($id->textContent);
    array_push($data,$ele);
}
$array['ids']=$data;



$imgs = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[1]/tbody/tr/td[2]/a/img');

$data=array(); 

foreach($imgs as $img)
{
    $ele=array();
    $ele['img']=trim($img->getAttribute('src'));
    array_push($data,$ele);
}
$array['imgs']=$data;




$names = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[1]/tbody/tr/td[3]/a');

$data=array();
foreach($names as $name)
{
    $ele=array();
    $ele['name']=trim($name->textContent);
    array_push($data,$ele);
}
$array['names']=$data;




*/
// $data=array();
// foreach ($ids as $id) {
//     $ele=array();
//     $ele['code']=trim($id->textContent);
//     array_push($data,$ele);
// }
// $array['ids']=$data;


//nodeValue
// getAttribute('value')
/*
$array=array();
for ($i = 0; $i < $options->length; $i++) 
{
   
   $option=$options->item($i);
   $ele=array();
   $ele['code']=trim($option->getAttribute('value'));
   array_push($data,$ele);
}
$array['currencies']=$data;
*/
