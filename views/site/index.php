<?php

/* @var $this yii\web\View */

$this->title = 'index page';
$this->params['breadcrumbs'][] = '';
?>
<div class="left-menu">
<div class="btn-left-menu user">Add User</div>
<div class="btn-left-menu task">Add task</div>
</div>
<div class="right-box">

</div>
<div class="result-box">

</div>
<script>
$(document).ready(function(){
	$('.user').on("click", function(){
		$.ajax({
			type: "POST",
			url: "<?= Yii::$app->homeUrl ?>?r=site/add_user_form",
			success: function(data){
				$('.right-box').html(data);				
				$.ajax({
					type: "POST",
					url: "<?= Yii::$app->homeUrl ?>?r=site/get_users",					
					success: function(data_1){
						$('.result-box').html(data_1);
					}
				});
				
			}
		});
	});
	$('body').on("click",".save", function(){
		$arrayOfData = [];
		$('input').each(function(){
			$arrayOfData.push([$(this).attr('id'), $(this).val()]);
		});
		$('select').each(function(){
			$arrayOfData.push([$(this).attr('id'), $(this).val()]);
		});
				
		$.ajax({
			type: "POST",
			url: "<?= Yii::$app->homeUrl ?>?r=site/add_users",	
			data: {						
				arrayOfData: $arrayOfData
			},			
			success: function(data){
				console.log(data);
				$.ajax({
					type: "POST",
					url: "<?= Yii::$app->homeUrl ?>?r=site/get_users",					
					success: function(data_1){
						$('.result-box').html(data_1);
					}
				});
			}
		});
				
	});
	$('body').on("click", ".user_card", function(){
		$.ajax({
			type: "POST",
			url: "<?= Yii::$app->homeUrl ?>?r=site/get_user_card",
			data: {
				id: $(this).attr('id'),
				user_id: $(this).data('id')
			},
			success: function(data){
				console.log(data);
				$('.right-box').html(data);
			}
		});
	});
});


</script>
