<?php
if(has_permission(new Permission(constant('Securable::' . strtoupper($this->model_name)), Permission_Type::CREATE)))
{
echo '<a href="?controller=' . $this->model_name . '&action=create" class="btn btn-primary">Create</a>';
echo '<a href="?controller=' . $this->model_name . '&action=create_file" class="btn btn-primary">Create from file</a><br>';
}
	echo '<h2>' . $this->model_name . ' List</h2>';
?>

<table class="table table-striped table-bordered">
<?php
//i am expecting $models to be defined!!!!!
//where do i store things like how many pages there should be?
//
$can_read = has_permission(new Permission(Securable::LESSON, Permission_Type::READ));
$can_edit = has_permission(new Permission(Securable::LESSON, Permission_Type::EDIT));

foreach($models as $k => $v)
{
?>
<tr>
	<td>
		<?php echo htmlspecialchars($v); ?>
	</td>
<?php
	if($can_read)
	{ ?>
	<td><ul class="actions">
		<li><a href="<?php echo '?controller=' . $this->model_name . '&action=read&id=' . $k;?>">View</a></li>
	<?php } 
	if($can_edit)
	{ ?>
		<li><a href="<?php echo '?controller=' . $this->model_name . '&action=update&id=' . $k;?>">Update</a></li>
	
		<li><a href="<?php echo '?controller=' . $this->model_name . '&action=delete&id=' . $k;?>" onclick="return confirm('Do you want to delete this lesson?')">Delete</a></li>
		</ul>
	</td>
	<?php } ?>
</tr>
<?php
}
?>
</table>
