<?
    if(intval($arParams['SECTION_ID']) > 0):
		$APPLICATION->SetTitle($arResult['SECTION']['NAME']);
        $APPLICATION->SetPageProperty('catalog_description', $arResult['~DESCRIPTION']);
	endif;
?>
