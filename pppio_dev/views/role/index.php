<table class="table table-striped table-bordered">
<?php
	echo '<h2>' . $this->model_name . ' List</h2>';
foreach($models as $k => $v)
{
?>
<tr>
	<td>
		<?php echo htmlspecialchars($v); ?>
	</td>
	<td>
		<a href="<?php echo '/?controller=' . $this->model_name . '&action=read&id=' . $k;?>">View</a><br>
	</td>
</tr>
<?php
}
?>
</table>