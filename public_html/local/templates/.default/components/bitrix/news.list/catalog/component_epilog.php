<?
	global $APPLICATION;
	$section = end($arResult['SECTION']['PATH']);
	$APPLICATION->SetTitle($section['NAME']);
	$APPLICATION->SetPageProperty('catalog_description', end($arResult['SECTION']['PATH'])['~DESCRIPTION']);
?>
