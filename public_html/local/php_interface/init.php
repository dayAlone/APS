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
?>