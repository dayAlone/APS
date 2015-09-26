<?
$arSections = array(
	0 => array('NAME'=>'Каталог')
);
$BG = false;
foreach($arResult['SECTION']['PATH'] as $section):
	$arSections[] = array('ID'=>$section['ID'], 'CODE'=>$section['CODE'], 'NAME'=>$section['NAME'], 'DEPTH_LEVEL' => $section['DEPTH_LEVEL']);
	if(intval($section['DETAIL_PICTURE'])>0)
		$BG = CFile::GetPath($section['DETAIL_PICTURE']);
endforeach;

$showLast = $APPLICATION->GetPageProperty('showLast');
$this->SetViewTarget('page_top');?>
	<?if(strlen($BG)>0):?>
		<style>
			.catalog .wrap {
				background-image: url(<?=$BG?>) !important;
				background-size: cover !important;
			}
		</style>
	<?endif;?>
	<ul class="dropdown"><?
    foreach ($arSections as $key => $elm):
    	if($key>0):
    	?>
		<li class="divider">&#9654;</li>
		<?endif;?>
        <?if(($key+1) < count($arSections) || !$showLast):?>
        	<li class="link">
	            <a href="/catalog/<?=$elm['CODE']?>/"><span><?=$elm['NAME']?></span></a>
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
		<?else:?>
			<li class="text">
			<span><?=$elm['NAME']?></span>
		<?endif;?>
		</li>
	<?
	endforeach;
	if(!$showLast):?>
		<li class="divider">&#9654;</li>
		<li class="text">
			<span><?=$APPLICATION->GetPageProperty('catalogItemName')?></span>
		</li>
	<?endif;?>
	</ul>
<?$this->EndViewTarget();?>
