<?php
require_once("baglan.php");

$GelenCevap		=	Filtre($_POST["cevap"]);

$KontrolSorgusu		=	$VeritabaniBaglantisi->prepare("SELECT * FROM oykullananlar WHERE ipadresi = ? AND tarih >= ?");
$KontrolSorgusu->execute([$IPAdresi, $ZamaniGeriAl]);
$KontrolSayisi		=	$KontrolSorgusu->rowCount();

if($KontrolSayisi>0){
	echo "HATA<br />";
	echo "Daha önce oy kullanmışsınız. Lütfen en az 24 saat sonra tekrar deneyiniz.<br />";
	echo "Anasayfaya dönmek için <a href='index.php'>tıklayınız.</a>";
}else{
	if($GelenCevap==1){
		$Guncelle	=	$VeritabaniBaglantisi->prepare("UPDATE anket SET oysayisibir=oysayisibir+1, toplamoysayisi=toplamoysayisi+1");
		$Guncelle->execute();
	}elseif($GelenCevap==2){
		$Guncelle	=	$VeritabaniBaglantisi->prepare("UPDATE anket SET oysayisiiki=oysayisiiki+1, toplamoysayisi=toplamoysayisi+1");
		$Guncelle->execute();
	}elseif($GelenCevap==3){
		$Guncelle	=	$VeritabaniBaglantisi->prepare("UPDATE anket SET oysayisiuc=oysayisiuc+1, toplamoysayisi=toplamoysayisi+1");
		$Guncelle->execute();
	}else{
		echo "HATA<br />";
		echo "Cevap Kaydı Bulunamıyor.<br />";
		echo "Anasayfaya dönmek için <a href='index.php'>tıklayınız.</a>";
	}
	
	$Ekle			=	$VeritabaniBaglantisi->prepare("INSERT INTO oykullananlar (ipadresi, tarih) values (?, ?)");
	$Ekle->execute([$IPAdresi, $ZamanDamgasi]);
	$EkleKontrol	=	$Ekle->rowCount();
	
	if($EkleKontrol>0){
		echo "TEŞEKKÜRLER<br />";
		echo "Vermiş Olduğunuz Oy Sisteme Kaydedildi.<br />";
		echo "Anasayfaya dönmek için <a href='index.php'>tıklayınız.</a>";

	}else{
		echo "HATA<br />";
		echo "İşlem Sırasında Beklenmeyen Bir Hata Oluştu. Lütfen Daha Sonra Tekrar Deneyiniz<br />";
		echo "Anasayfaya dönmek için <a href='index.php'>tıklayınız.</a>";
	}
}

$VeritabaniBaglantisi	=	null;
?>