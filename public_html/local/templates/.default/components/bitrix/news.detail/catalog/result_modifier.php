<?
    $item = &$arResult;
    function images_sort($a, $b)
    {
        if($a['sort']=='' && $b['sort']>0) 
            return 1;

        if($b['sort']=='' && $a['sort']>0) 
            return -1;

        if($a['sort']=='' && $b['sort']=='')
            return ($a['value'] < $b['value']) ? -1 : 1;

        if ($a['sort'] == $b['sort'])
            return 0;

        return ($a['sort'] < $b['sort']) ? -1 : 1;
    }
    $gallery     = array();
    $prop_names   = array("GALLERY","IMAGES");
    foreach ($prop_names as $prop_name) {
        $description = $item['PROPERTIES'][$prop_name]['DESCRIPTION'];
        if(is_array($item['PROPERTIES'][$prop_name]['VALUE'])):
            foreach ($item['PROPERTIES'][$prop_name]['VALUE'] as $key => $value):
                  $small = CFile::ResizeImageGet($value, Array("width" => 312, "height" => 312), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 100);
                  $big = CFile::ResizeImageGet($value, Array("width" => 800, "height" => 700), BX_RESIZE_IMAGE_PROPORTIONAL, false, false, false, 100);
                  $gallery[] = array('sort'=>$description[$key], 'value'=> $big['src'], 'small'=> $small['src']);
            endforeach;

            usort($gallery, "images_sort");

            $item[$prop_name] = $gallery;
        endif;
    }
    
    
    preg_match('(?<=(?:v|i)=)[a-zA-Z0-9-]+(?=&)|(?<=(?:v|i)\/)[^&\n]+|(?<=embed\/)[^"&\n]+|(?<=‌​(?:v|i)=)[^&\n]+|(?<=youtu.be\/)[^&\n]+', $item['PROPERTIES']['VIDEO']['VALUE'], $matches);
?>