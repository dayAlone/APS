<?
	foreach ($arResult['ITEMS'] as &$item):
		$item["PROPS"] = array();
		$props = &$item["PROPS"];
		$res = CIBlockSection::GetByID($item['IBLOCK_SECTION_ID']);
		$ar_res = $res->Fetch();
		$props['SECTION'] = $ar_res['CODE'];
		foreach ($item["PROPERTIES"] as $key => $prop):
			switch ($prop['CODE']):
				case "GEO":
					$props[$prop["CODE"]] = $prop["VALUE"];
				break;
			endswitch;
		endforeach;

	endforeach;
	
?>