<?$this->setFrameMode(true);
$item = $arResult;
$props = &$item["PROPS"];
include($_SERVER['DOCUMENT_ROOT']."/seo.php");
?>
<div class="product">
	  <div class="product__name hidden-lg hidden-md"><h1><?if(isset($seoh1) AND $seoh1!=''){echo $seoh1;}
			else {echo $item['NAME'];} ?></h1></div>
	<div class="row">
	  <div class="col-md-6 col-lg-5">
	  	<div class="product__image">
  				<div class="product__image-big" data-images='<?=json_encode($props["PHOTOS"])?>'>
		  			<?foreach ($props['PHOTOS'] as $key => $value):?>
	                	<a id="big-<?=$key?>" style="background-image: url(<?=$value['small']?>)" href="#" <?=($key==0?'class="active"':'')?>></a>
	                <?endforeach;?>
		  		</div>
				<?if(count($props['PHOTOS'])>1):
					?><div class="product__image-small"><?
						foreach ($props['PHOTOS'] as $key => $value):
	                    	if($key > 3) continue;
	                    ?><a style="background-image: url(<?=$value['small']?>)" data-id="#big-<?=$key?>" <?=($key==0?'class="active"':'')?> href="#"></a><?
						endforeach;
					?></div><?
				endif;?>
				<div class="center">
					<a role="tab" data-toggle="modal" data-product="<?=$item['NAME']?>" data-target="#Feedback" href="#Feedback" class="product__order">Заказать</a>
				</div>



	  	</div>
	  </div>
	  <div class="col-md-6 col-lg-7">
		  <div class="product__name hidden-sm hidden-xs"><h1><?if(isset($seoh1) AND $seoh1!=''){echo $seoh1;}
                else {echo $item['NAME'];} ?></h1></div>
	  	<div class="product__text">
	  		<?=$item['~DETAIL_TEXT']?>
	  	</div>
	  </div>
	</div>
		<!-- Nav tabs -->
	<div class="tabs" role="tablist">
		<ul>
			<?
				$i=0;
				$tabs = array('ADDITIONAL'=>array('name'=>'Описание', 'id'=>'description'), 'ABOUT'=>array('name'=>'Характеристики', 'id'=>'tech'));
				foreach ($tabs as $key => $value):
					if(count($props[$key])>0):
						$i++;
					?><li class="<?=($i==1?"active":"")?>"><a class="tabs__link" href="#<?=$value['id']?>" role="tab" data-toggle="tab"><?=$value['name']?></a></li><?
					endif;
				endforeach;
			?>
		</ul>
		<?
			$i=0;
			$tabs = array('description'=>'ADDITIONAL', 'tech'=>'ABOUT');
			foreach ($tabs as $key => $value):
				$title = false;
				if(count($props[$value])>0):
	        		$i++;?>
	        		<div class="tabs__content fade in <?=($i==1?"active":"")?>" id="<?=$key?>">
	        		<?
	        		foreach ($props[$value] as $k => $elm):
	        			switch ($value):
	        				case 'ADDITIONAL':
	        					?>
	        					<div class="params__title"><?=$elm['property_name']?></div>
								<div class="params">

									<div class="row">
										<div class="col-xs-12">
										<?=html_entity_decode($elm['property_value'])?>
										</div>
									</div>
								</div>
	        					<?
	        					break;
	        				case 'ABOUT':
	        						if($elm['property_title']=="Y" || $k == 0):
									  if(!$title) $title = true;
									  if($k!=0) echo "</div></div>";
									?>
									<div class="params__title"><?=$elm['property_name']?></div>
									  <div class="params params--table">

									    <div class="params__frame">
									<?
									else:
										if(strlen($elm['property_name'])>0):
											$count = 0;
											foreach ($elm as $v)
												if(strlen($v)>0)
													$count++;
										?>
										<div class="row no-gutter <?=($count==1?"row--title":"")?>">
											<?
											foreach ($elm as $x => $v){
												if(strlen($v) > 0){
													$s = 12/$count;
													?><div class="col-xs-1" style="width: <?=(100/$count)?>%"><span><?=html_entity_decode($v)?></span></div><?
												}
											}
											?>
										</div>
										<?
										endif;
									endif;
									if(!isset($props[$value][$k+1])) echo "</div></div>";
	        					break;
	        			endswitch;
	        		endforeach;
	        		?>
	        		</div>
	        		<?
	        	endif;
			endforeach;
		?>
	</div>
	<?$section = end($arResult['SECTION']['PATH']);?>
	<a href="/catalog/<?=$section['CODE']?>/" class="product__back"><?=svg('back')?> <span>вернуться в раздел «<?=$section['NAME']?>»</span></a>

</div>
<?require_once($_SERVER['DOCUMENT_ROOT'].'/include/dropdown.php')?>
