<?php 
require_once 'vendor/autoload.php';
use \DantSu\PHPImageEditor\Image;

$names = ['Imtiaz Mahmud Riad','Abu Bokor Siddiq','Sonali Tripura','MD Nazmul Hasan Bhuiyan','Tajnuba Alam Saba'];

foreach($names as $name){
    Image::fromPath(__DIR__ . '/example.jpg')
    ->writeText($name,__DIR__ . '/font.ttf',26,'#000000',Image::ALIGN_CENTER,345,Image::ALIGN_CENTER,Image::ALIGN_TOP,0,1.5)
    ->saveJPG(__DIR__ . '/certificate/'.$name.'.jpg',100);
}