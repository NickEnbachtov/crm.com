<?php

/* @var $this yii\web\View */

$this->title = 'index page';
?>
<?php
//echo dirname(__DIR__);
?>
<div class="left-menu">
<div class="btn-left-menu user">Add User</div>
<div class="btn-left-menu task">Add task</div>
</div>
<div class="right-box">

</div>
<script>
$(document).ready(function(){
	$('.user').on("click", function(){
		$.ajax({
			type: "POST",
			url: "<?= Yii::$app->homeUrl ?>?r=site/add_user_form",
			success: function(data){
				$('.right-box').html(data);
			}
		});
	});
});


</script>
