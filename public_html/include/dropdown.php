<?
$arSections = array(
	0 => array('NAME'=>'Каталог')
);
foreach($arResult['SECTION']['PATH'] as $section):
	$arSections[] = array('ID'=>$section['ID'], 'NAME'=>$section['NAME'], 'DEPTH_LEVEL' => $section['DEPTH_LEVEL']);
endforeach;
$this->SetViewTarget('page_top');?>
	<ul class="dropdown"><?
    foreach ($arSections as $key => $elm):
    	if($key>0):
    	?>
		<li class="divider">&#9654;</li>
		<?endif;?>
        <li>
            <a href="#"><?=$elm['NAME']?></a>
            <?
				$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "dropdown", array(
					"IBLOCK_TYPE" => "news",
					"IBLOCK_ID"   => "1",
					"TOP_DEPTH"   => "4",
					"CACHE_TYPE"  => "A",
					"SECTION_ID"  => $elm['ID']
			  ),
			  false
			  );
			?>
		</li>
	<?
	endforeach;?>
	</ul>
	<div class="page__divider m-margin-top m-margin-bottom"></div>
<?$this->EndViewTarget();?>