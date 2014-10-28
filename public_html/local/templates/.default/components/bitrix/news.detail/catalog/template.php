<?$this->setFrameMode(true);
$item = $arResult;
$props = &$item["PROPS"];
?>
<div class="product">
	<div class="row">
	  <div class="col-md-6 col-md-push-6">
	  	
	  </div>
	  <div class="col-md-6 col-md-pull-6">
	  	<h1 class="product__name"><?=$item['NAME']?></h1>
	  	<div class="product__text">
	  		<?=$item['DETAIL_TEXT']?>
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
								<div class="params">
									<div class="params__title"><?=$elm['property_name']?></div>
									<?=$elm['property_value']?>
								</div>
	        					<?
	        					break;
	        				case 'ABOUT':
	        						if($elm['property_title']=="Y"):
									  if(!$title) $title = true;
									  if($k!=0) echo "</div>";
									?>
									  <div class="params params--list">
									    <div class="params__title"><?=$elm['property_name']?></div>
									<?
									else:
										if(strlen($elm['property_name'])>0):
										?>
										<div class="row no-gutter">
											<div class="col-md-5 col-xs-5"><?=$elm['property_name']?>:</div>
											<div class="col-md-7 col-xs-7"><?=$elm['property_value']?></div>
										</div>
										<?
										endif;
									endif;
									if(!isset($props[$value][$k+1])) echo "</div>";
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
</div>