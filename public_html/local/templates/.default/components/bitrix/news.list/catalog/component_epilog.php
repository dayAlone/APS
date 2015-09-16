<?
	global $APPLICATION;
	$section = end($arResult['SECTION']['PATH']);
	$APPLICATION->SetTitle($section['NAME']);
	$last = end($arResult['SECTION']['PATH']);
	$APPLICATION->SetPageProperty('catalog_description', $last['~DESCRIPTION']);
?>
