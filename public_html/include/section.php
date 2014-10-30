<?
	if(isset($_POST['SORT_BY1']))
		$_SESSION['SORT_BY1'] = $_POST['SORT_BY1'];
	if(isset($_POST['SORT_ORDER1']))
		$_SESSION['SORT_ORDER1'] = $_POST['SORT_ORDER1'];

	$params = $APPLICATION->GetPageProperty('section');

	if(isset($_REQUEST['ELEMENT_CODE'])):
		$obCache       = new CPHPCache();
		$cacheLifetime = 86400; 
		$cacheID       = $params['CODE'].'_'.$_REQUEST['ELEMENT_CODE']; 
		$cachePath     = '/'.$cacheID;

		if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) ):

		   $vars = $obCache->GetVars();
		   $_GLOBALS['currentCatalogSection'] = $vars['current'];
		   $_GLOBALS['openCatalogSection']    = $vars['open'];

		elseif( $obCache->StartDataCache() ):

			CModule::IncludeModule("iblock");
			
			$Current    = false;
			$Open       = false;

			$Sections   = array();
			$arSort     = array("DEPTH_LEVEL" => "ASC");
			$arFilter   = array("IBLOCK_ID" => $params['IBLOCK']);
			$rsSections = CIBlockSection::GetList($arSort, $arFilter);
			
			while ($s = $rsSections->Fetch()) {
				if(strlen($_REQUEST['ELEMENT_CODE'])>0):
					if($s['CODE']==$_REQUEST['ELEMENT_CODE']) {
						$arFilter = Array(
							"IBLOCK_ID"  => $params['IBLOCK'],
							"SECTION_ID" => $s['ID']
					    );
						if(CIBlockSection::GetCount($arFilter) > 0)
							$Open = $s['ID'];
						else
							$Current = $s['ID'];
					}	
				endif;
			}

			if(strlen($_REQUEST['ELEMENT_CODE'])==0)
				$Current = $Sections[0];

			$_GLOBALS['currentCatalogSection'] = $Current;
			$_GLOBALS['openCatalogSection']    = $Open;
			
			$obCache->EndDataCache(array('current' => $Current, 'open' => $Open));
		endif;
	endif;
?>