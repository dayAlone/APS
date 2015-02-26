<?
if(count($arResult['SECTIONS'])>0):
	function buildTree(array &$elements, $parentId = 0) {
	    $branch = array();
	    foreach ($elements as $key => $element) {
	    	if ($element['PARENT'] == $parentId) {
	            $children = buildTree($elements, $element['ID']);
	            if ($children)
	                $element['CHILD'] = $children;
	            $branch[$element['ID']] = $element;
	            //unset($elements[$key]);
	        }
	    }
	    return $branch;
	}
	$all = array();
	foreach ($arResult['SECTIONS'] as $key => &$item)
		$all[$item['ID']] = array(
				'ID'     => intval($item['ID']),
				'NAME'   => $item['NAME'],
				'IMAGE'  => $item['PICTURE']['SRC'],
				'URL'    => $item['SECTION_PAGE_URL'],
				'ICON'   => ($item['UF_SVG']?file_get_contents($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($item['UF_SVG'])):""),
				'DEPTH'  => $item['DEPTH_LEVEL'],
				'PARENT' => intval($item['IBLOCK_SECTION_ID'])
		);
	$arResult['SECTIONS'] = buildTree($all);
endif;
?>