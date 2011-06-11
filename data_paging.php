<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PHP Data Paging</title>
</head>
<body>
<?php
/*
FK Data Paging
Author: Firat KOYUNCU
Nickname: FK Designer
Website: www.fkdesigner.com
E-Mail: fkdesigner@hotmail.com - iletisim@fkdesigner.com
Facebook Page: www.facebook.com/fkdesigner
Twitter Page: www.twitter.com/fkdesigner
*/

#DON'T FORGET TO WRITE YOUR CODES TO CONNECT YOUR DATABASE IN THIS LINE!

//Paging Process:
//We're taking page number with no variable.
@$no = $_GET["no"];
//With that code; we're blocking to entering anything except for a number.
if (eregi ("^[0-9]{1,}$", $no, $no)){
$no = $no[0];
}
else {
$no = 1;
}
//If page number isn't entered, first page will open.
if(empty($no)){
$no = 1;
}
//Please edit here what you want. This is the limit how many datas is shown in each page. Default: 10.
$sayfalik_kayit = 10;
//Total records.
#BELOW THIS LINE, I WROTE "veritabanim" as my database. Please rewrite that code for you to take datas from your database.
$toplam = mysql_query("SELECT * FROM veritabanim");
$toplam_kayit = mysql_num_rows($toplam);
//Toplam sayfa sayisi bulunuyor.
$toplam_sayfa = ceil($toplam_kayit/$sayfalik_kayit);
//If the number which can not be found; automatically, first page opens.
if($no>$toplam_sayfa){
$no=1;
}
//The records will list with this start number in the page which is opened.
$baslangic = (($no*$sayfalik_kayit)-$sayfalik_kayit);
///The records will list with this last number in the page which is opened.
$bitis = ($no * $sayfalik_kayit);
//Datas which are selected be listed.
#WE USED "veritabanim" AS DATABASE NAME, AGAIN.
$veriler = mysql_query("select * from veritabanim order by no limit $baslangic,$bitis");
//If the page which is opened is higher than 1, we will print back link. 
if($no>1){
echo '<a href='.$PHP_SELF.'?no='.($no-1).'>Back</a> | ';
}
//There is a for loop to print other pages' links.
for($i=0; $i<$toplam_sayfa; $i++){
	if($no == ($i+1)){
	echo ($i+1).' ';
	}
	else{
	echo' <a href='.$PHP_SELF.'?no='.($i+1).'>'.($i+1).'</a> ';
	}
}
//If total pages number is higher than the page which is opened, we will print forward link.
if($toplam_sayfa>$no){
echo'| <a href='.$PHP_SELF.'?no='.($no+1).'>Forward</a>';
}
//WRITING DATAS:
while($veri = mysql_fetch_array($veriler)){ 
	echo $veri['veri'];
}
?>
</body>
</html>
