<?
global $APPLICATION;
$aMenuLinks = $APPLICATION->IncludeComponent("bitrix:menu.sections","",Array(
        "IS_SEF" => "Y", 
        "SEF_BASE_URL" => "/catalog/", 
        "SECTION_PAGE_URL" => "#SECTION_CODE#/", 
        "DETAIL_PAGE_URL" => "#ELEMENT_CODE#/", 
        "IBLOCK_TYPE" => "news", 
        "IBLOCK_ID" => "1", 
        "DEPTH_LEVEL" => "2", 
        "CACHE_TYPE" => "A", 
        "CACHE_TIME" => "3600" 
    )
);
?>