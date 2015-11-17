<div class="form">
<div class="head-box"><div style="padding-left: 5px">User's card</div></div>
<table class="table-add " style="width: 100%;">
<tr>
	<td style="width: 100px"><img src="<?= $user_card['img'] ?>" alt="photo" style="width: 100px;height: 100px; border: 1px solid #0277BD; margin-right: 5px"></td>
	<td style="width: 100%;">
		<table style="width: 100%;">
			<tr><td style="padding-right: 5px;font-weight:bold">Name: </td><td style="width: 100%;"><?= $user_info['firstname'] ?> <?= $user_info['lastname'] ?></td></tr>
			<tr><td style="padding-right: 5px;font-weight:bold">Department: </td><td style="width: 100%;"><?= $user_card['department'] ?></td></tr>
			<tr><td style="padding-right: 5px;font-weight:bold">Position: </td><td style="width: 100%;"><?= $user_card['position'] ?></td></tr>
		</table>
	</td>
</tr>
<tr>
<td style="padding-right: 5px;font-weight:bold">Phone: </td><td><?= $user_card['phone'] ?></td>
</tr>
<tr>
<td style="padding-right: 5px;font-weight:bold">E-mail: </td><td><?= $user_card['e-mail'] ?></td>
</tr>
</table>
</div>
