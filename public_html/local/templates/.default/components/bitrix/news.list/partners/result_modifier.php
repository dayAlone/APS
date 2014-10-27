<?
foreach ($arResult['ITEMS'] as &$item):
	$item['IMAGE'] = $item['PREVIEW_PICTURE']['SRC'];
	$item['LINK'] = $item['PROPERTIES']['LINK']['VALUE'];
endforeach;
?>