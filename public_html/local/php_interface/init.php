<?
function svg($value='')
{
	$path = $_SERVER["DOCUMENT_ROOT"]."/layout/images/svg/".$value.".svg";
	return file_get_contents($path);
}
function body_class()
{
	global $APPLICATION;
	if($APPLICATION->GetPageProperty('body_class')) {
		return $APPLICATION->GetPageProperty('body_class');
	}
}
function article_class()
{
	global $APPLICATION;
	if($APPLICATION->GetPageProperty('article_class')) {
		return $APPLICATION->GetPageProperty('article_class');
	}
}
function IBlockElementsMenu($IBLOCK_ID)
{
	$obCache       = new CPHPCache();
	$cacheLifetime = 86400; 
	$cacheID       = 'IBlockElementsMenu_'.$IBLOCK_ID; 
	$cachePath     = '/'.$cacheID;

	if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) )
	{
	   $vars = $obCache->GetVars();
	   return $vars['NAV'];
	}
	elseif( $obCache->StartDataCache()  )
	{
		CModule::IncludeModule("iblock");
		
		$arNav    = array();
		$arSort   = array("NAME" => "DESC");
		$arFilter = array("IBLOCK_ID" => $IBLOCK_ID, 'ACTIVE'=>'Y');
		$rs       = CIBlockElement::GetList($arSort, $arFilter, false, false);
		//$rs->SetUrlTemplates("/catalog/#SECTION_CODE#/#ELEMENT_CODE#.php");

		while ($item = $rs->GetNext()):
			$arNav[] = Array(
				$item['NAME'], 
				$item['DETAIL_PAGE_URL'], 
				Array(), 
				Array(), 
				"" 
			);
		endwhile;

		$obCache->EndDataCache(array('NAV' => $arNav));

		return $arNav;
	}
}
function r_date($date = '') {

	$date = strtotime($date);

	$treplace = array (
		"Январь"   => "января",
		"Февраль"  => "февраля",
		"Март"     => "марта",
		"Апрель"   => "апреля",
		"Май"      => "мая",
		"Июнь"     => "июня",
		"Июль"     => "июля",
		"Август"   => "августа",
		"Сентябрь" => "сентября",
		"Октябрь"  => "октября",
		"Ноябрь"   => "ноября",
		"Декабрь"  => "декабря",
		"January"   => "января",
		"February"  => "февраля",
		"March"     => "марта",
		"April"   => "апреля",
		"May"      => "мая",
		"June"     => "июня",
		"July"     => "июля",
		"August"   => "августа",
		"September" => "сентября",
		"October"  => "октября",
		"November"   => "ноября",
		"December"  => "декабря",
		"*"        => "",
		"th"       => "",
		"st"       => "",
		"nd"       => "",
		"rd"       => ""
	);
   	return strtr(date('d F Y', $date), $treplace);
}
AddEventHandler("main", "OnAdminTabControlBegin", "MyOnAdminTabControlBegin");
function MyOnAdminTabControlBegin(&$form)
{
	?>
	<script src="/layout/js/frontend.js"></script>
	<link rel="stylesheet" href="/layout/css/modals.css"/>
	<style>
		.modal-content {
			padding: 30px 40px;
		}
		.modal-content .adm-workarea {
			padding: 0;
			text-align: right;
		}
		.modal-content .bx-yandex-map {
			width: 100% !important;
			margin-bottom: 20px;
		}
	</style>
	<div id="mapPopup" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade" data-backdrop="backdrop">
	  <div class="modal-dialog modal-lg">
	  	
        <div class="modal-content">
	      <div class="map">
	      	
	      </div>
	      <div class="adm-workarea">
	      	<input type="button" class="button" name="dontsave" id="dontsave"  data-dismiss="modal" value="Отменить">
	      	<input type="button" class="adm-btn-save" value="Сохранить">
	      </div>
	    </div>
	  </div>
	</div>
	<?
}
AddEventHandler("main", "OnEndBufferContent", "OnEndBufferContentHandler");
function OnEndBufferContentHandler(&$content)
{
	if(!strstr($_SERVER['SCRIPT_NAME'], 'bitrix/admin')):
	   $pattern = '/{GALLERY:(\d*|\s\d*)}/i';
	   if(preg_match($pattern, $content, $matches, false, false)):
	   	ob_start();
	   		global $APPLICATION;
			$APPLICATION->IncludeComponent("bitrix:news.detail","gallery",Array(
				"IBLOCK_ID"     => "6",
				"ELEMENT_ID"    => $matches[1],
				"CHECK_DATES"   => "N",
				"IBLOCK_TYPE"   => "content",
				"SET_TITLE"     => "N",
				"PROPERTY_CODE" => Array("PHOTOS"),
				"CACHE_TYPE"    => "A",
			));
	   		$gallery = ob_get_contents();
		ob_end_clean();
	   	$content = str_replace($matches[0], $gallery, $content);
	   endif;
	endif;
}
?>