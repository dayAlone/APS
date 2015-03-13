<?
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
?>
<div class="container">
	<div class="page__frame" style="<?=($_COOKIE['frameHeight']>0?"min-height:".$_COOKIE['frameHeight']."px":"")?>">
		<?$APPLICATION->ShowViewContent('page_top');?>