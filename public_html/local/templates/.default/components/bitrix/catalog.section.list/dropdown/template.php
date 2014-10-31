<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
function getDropdown($sections, $depth, $maxDepth)
{
    $del = -(1-$depth);
    if($del>0)
        foreach ($sections as &$item)
            $item['DEPTH_LEVEL'] -= $del;

    foreach ($sections as $key => $item):
        if(!isset($sections[$key-1])):
            echo '<ul>';
        else:
            if($sections[$key-1]['DEPTH_LEVEL']<$item['DEPTH_LEVEL']):
                echo '<ul>';
            elseif($sections[$key-1]['DEPTH_LEVEL']>$item['DEPTH_LEVEL']):
                 for ($i=0; $i < $sections[$key-1]['DEPTH_LEVEL']-$item['DEPTH_LEVEL']+2; $i++)
                    echo "</ul>";
            endif;
        endif;

        echo "<li><a href='#'>".$item['NAME']."</a></li>";

        if(!isset($sections[$key+1])):
            for ($i=0; $i < $item['DEPTH_LEVEL']; $i++)
                    echo "</ul>";
        endif;
    endforeach;
}

class filterArray {
    private $num;

    public static $maxDepth;

    function __construct($num) {
            $this->num = $num;
    }

    function isBigger($i) {
        if(filterArray::$maxDepth < $i['DEPTH_LEVEL'])
            filterArray::$maxDepth = $i['DEPTH_LEVEL'];

        return $i['DEPTH_LEVEL'] >= $this->num;
    }
}

if(count($arResult['SECTIONS'])>0):
    foreach ($arParams["CACHE_NOTES"] as $elm):
        $sections =  array_values(array_filter($arResult['SECTIONS'], array(new filterArray($elm['DEPTH_LEVEL']), 'isBigger')));
        /*
        if($elm['DEPTH_LEVEL']>1)
            getDropdown($sections, $elm['DEPTH_LEVEL'], filterArray::$maxDepth);
        */
    endforeach;
endif;
?>