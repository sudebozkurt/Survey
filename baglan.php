<?php
try{
	$VeritabaniBaglantisi	=	new PDO("mysql:host=localhost;dbname=project6;charset=UTF8", "root", "");
}catch(PDOException $Hata){
	echo $Hata->getMessage();
	die();
}

function Filtre($Deger){
	$Bir	=	trim($Deger);
	$Iki	=	strip_tags($Bir);
	$Uc		=	htmlspecialchars($Iki, ENT_QUOTES);
	$Sonuc	=	$Uc;
	return $Sonuc;
}

$IPAdresi			=	$_SERVER["REMOTE_ADDR"];
$ZamanDamgasi		=	time();
$OyKullanmaSiniri	=	86400; // Saniye Cinsinden
$ZamaniGeriAl		=	$ZamanDamgasi-$OyKullanmaSiniri;
?>