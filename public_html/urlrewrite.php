<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/press/([\w-_]+)/.*#",
		"RULE" => "&ELEMENT_CODE=\$1&\$2",
		"ID" => "",
		"PATH" => "/press/index.php",
	),
	array(
		"CONDITION" => "#^/career/([\w-_]+)/.*#",
		"RULE" => "&ELEMENT_CODE=\$1&\$2",
		"ID" => "",
		"PATH" => "/career/index.php",
	),
	array(
		"CONDITION" => "#^/catalog/([\w-_]+)/.*#",
		"RULE" => "&ELEMENT_CODE=\$1&\$2",
		"ID" => "",
		"PATH" => "/catalog/index.php",
	)
);

?>