<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(count($arResult['SECTIONS'])>0):
    $sections = $arResult['SECTIONS'];
    
    $del = -(1-$sections[0]['DEPTH_LEVEL']);
    /*
    if($del>0)
        foreach ($sections as &$item)
            $item['DEPTH_LEVEL'] -= $del;
    */
    $open = 0;
    $close = 0;
    foreach ($sections as $key => $item):
        if(!isset($sections[$key-1])):
            echo '<ul>';
            $open++;
        else:
            if($sections[$key-1]['DEPTH_LEVEL']<$item['DEPTH_LEVEL']):
                echo '<ul>';
                $open++;
            elseif($sections[$key-1]['DEPTH_LEVEL']>$item['DEPTH_LEVEL']):
                for ($i=0; $i < $sections[$key-1]['DEPTH_LEVEL']-$item['DEPTH_LEVEL']; $i++){
                    echo "</ul>";
                    $close++;
                }
                echo '</li>';
            endif;
        endif;

        echo "<li><a href='/catalog/".$item['CODE']."/'>".$item['NAME']."</a>";

        if(isset($sections[$key+1]))
            if($sections[$key+1]['DEPTH_LEVEL'] == $item['DEPTH_LEVEL'])
                echo '</li>';

        if(!isset($sections[$key+1])):
            for ($i=$del; $i < $item['DEPTH_LEVEL']; $i++) {
                echo "</ul>";
                $close++;
            }
        endif;
    endforeach;
endif;
?>