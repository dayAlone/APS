<?
$obCache       = new CPHPCache();
$cacheLifetime = 86400; 
$cacheID       = $_REQUEST['ELEMENT_CODE']; 
$cachePath     = '/'.$cacheID;

if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) )
{
   $vars = $obCache->GetVars();
   $_GLOBALS['currentNewsSection'] = $vars['current'];
}
elseif( $obCache->StartDataCache()  )
{
	CModule::IncludeModule("iblock");
	
	$Sections   = array();
	$arSort     = array("NAME" => "DESC");
	$arFilter   = array("IBLOCK_ID" => 1);
	$rsSections = CIBlockSection::GetList($arSort, $arFilter);
	
	while ($s = $rsSections->Fetch()){
		$Sections[] = $s['ID'];
		if(strlen($_REQUEST['ELEMENT_CODE'])>0):
			if($s['NAME']==$_REQUEST['ELEMENT_CODE'])
				$Current = $s['ID'];
		endif;
	}
	
	if(strlen($_REQUEST['ELEMENT_CODE'])==0)
		$Current = $Sections[0];

	$_GLOBALS['currentNewsSection'] = $Current;
	
	$obCache->EndDataCache(array('current' => $Current));
}
?>