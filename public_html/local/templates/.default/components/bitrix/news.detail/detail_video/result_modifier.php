<?
    $item = &$arResult;
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $item['PROPERTIES']['VIDEO']['VALUE'], $matches);
    $item['VIDEO'] = $matches[0];
?>