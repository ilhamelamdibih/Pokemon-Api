<?php 

require 'functions.php';

$site="https://bulbapedia.bulbagarden.net/wiki/".$_GET['name'];

$html = curl($site);



$idom = new DOMDocument();
@$idom->loadHTML($html);
$ixpath = new DOMXPath($idom);

$type = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[2]/tbody/tr[2]/td/table/tbody/tr/td[1]/table/tbody/tr/td[1]/a/span/b');
$name = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[2]/tbody/tr[1]/td/table/tbody/tr[1]/td/table/tbody/tr/td[1]/big/big/b');
$gender = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[2]/tbody/tr[4]/td[1]/table/tbody/tr[2]/td/a/span');
$catchRate = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[2]/tbody/tr[4]/td[2]/table/tbody/tr/td/text()');
$eggGroup = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[2]/tbody/tr[5]/td/table/tbody/tr/td[1]/table/tbody/tr/td/a/span');
$height = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[2]/tbody/tr[6]/td[1]/table/tbody/tr[1]/td[2]');
$weight = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[2]/tbody/tr[6]/td[2]/table/tbody/tr[1]/td[2]');
$img = $ixpath->evaluate('//*[@id="mw-content-text"]/div/table[2]/tbody/tr[1]/td/table/tbody/tr[2]/td/table/tbody/tr[1]/td/a/img');

$gds="";
for($i=0;$i<count($gender);$i++)
{
    if($i==0)
        $gds.=$gender[$i]->textContent;
    if($i==2)
        $gds.=",".$gender[$i]->textContent;
}



$data=array();

$data['type']=$type[0]->textContent;
$data['name']=$name[0]->textContent;
$data['height']=str_replace("\n", "",$height[0]->textContent);
$data['weight']=str_replace("\n", "",$weight[0]->textContent);
$data['catchRate']=$catchRate[0]->textContent;
$data['eggGroup']=$eggGroup[0]->textContent;
$data['img']=trim("https:".$img[0]->getAttribute('src'));
$data['gender']=$gds;   

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);

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
