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
			<li class="active"><a class="tabs__link" href="#description" role="tab" data-toggle="tab">Описание</a></li>
			<li><a class="tabs__link" href="#tech" role="tab" data-toggle="tab">Характеристики</a></li>
		</ul>
		<div class="tabs__content fade in active" id="description">...</div>
		<div class="tabs__content fade" id="tech">...</div>
	</div>
</div>