<?
if(count($arResult['SECTIONS'])>0):
	$all = array();
	if(intval($arParams['SECTION_ID']) > 0):
		$path = GetIBlockSectionPath($arResult['IBLOCK_ID'], $arParams['SECTION_ID'])->Fetch();
		$path = CIBlockSection::GetList(array('ID' => 'ASC'), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID'=>$path['ID']), true, array('UF_SVG'))->GetNext();
		require_once($_SERVER['DOCUMENT_ROOT'].'/include/dropdown.php');
	endif;
	foreach ($arResult['SECTIONS'] as $key => &$item)
		$all[$item['ID']] = array(
				'ID'     => intval($item['ID']),
				'NAME'   => $item['NAME'],
				'IMAGE'  => $item['PICTURE']['SRC'],
				'URL'    => $item['SECTION_PAGE_URL'],
				'ICON'   => ($item['UF_SVG'] ?
								file_get_contents($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($item['UF_SVG'])) :
								( $path ? file_get_contents($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($path['UF_SVG'])) : "")
							),
				'DEPTH'  => $item['DEPTH_LEVEL'],
				'PARENT' => intval($item['IBLOCK_SECTION_ID'])
		);
	$arResult['SECTIONS'] = $all;
endif;

?>
