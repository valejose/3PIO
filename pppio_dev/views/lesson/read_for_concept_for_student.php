<?php

	require_once('views/shared/html_helper.php');
	require_once('enums/completion_status.php');

	//$lesson_props = $lesson->get_properties();
	//$exercises = $lesson_props['exercises'];
	//$concept_id = intval($_GET['concept_id']);
	echo '<h1>' . htmlspecialchars($concept->get_properties()['name']) . '</h1>';
	//echo '<p>' . htmlspecialchars($lesson_props['description']) . '</p>';

	$total_exercise_count = 0;
	$completed_exercise_count = 0;
	$current_exercise_id;
	$current_lesson_id;
	$found_current = false;
	$lesson_completion_percentage = 0;

	foreach($lessons as $lesson)
	{
		$lesson_props = $lesson->get_properties();
		$exercises = $lesson_props['exercises'];
		$total_exercise_count += count($exercises);
		foreach($exercises as $exercise_id => $exercise_obj)
		{
			if($exercise_obj->status == Completion_Status::COMPLETED || $can_preview)
			{
				$completed_exercise_count++;
			}
			else
			{
				if(!$found_current)
				{
					$current_lesson_id = $lesson->get_id();	
					$current_exercise_id = $exercise_id;
					$found_current = true;
				}
			}
		}
	}
	if($total_exercise_count > 0)
	{
		$lesson_completion_percentage = $completed_exercise_count/(float)$total_exercise_count * 100;
	}

	echo '<div class="progress">
		  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: ' . $lesson_completion_percentage . '%">
			<span class="sr-only">' . $lesson_completion_percentage . '% Complete (success)</span>
		  </div>
		</div>';


	if(isset($current_exercise_id))
	{
		echo '<p><a href="?controller=exercise&action=try_it&id=' . $current_exercise_id . '&lesson_id=' . $current_lesson_id . '&concept_id=' . $concept->get_id()  . '" class="btn btn-default btn-lg">Continue</a></p>';
	}
	//print_r($current_exercise_id);
	
	echo '<div class="row">'; //abusing row...

	$i = 1;
	$found_current = false;
	foreach($lessons as $lesson)
	{
		$lesson_props = $lesson->get_properties();
		$exercises = $lesson_props['exercises'];
		foreach($exercises as $exercise_id => $exercise_obj)
		{
			echo '<div class="col-md-2 col-xs-4 text-center">';

			if($exercise_obj->status == Completion_Status::COMPLETED || $can_preview)
			{
				echo '<a href="?controller=exercise&action=try_it&id=' . $exercise_id . '&lesson_id=' . $lesson->get_id() . '&concept_id=' . $concept->get_id() . '" class="tile btn btn-success"><span class="tile-number">' . $i . '</span><span class="tile-label">' . htmlspecialchars($lesson_props['name']) . '</span></a>';
			}
			elseif (!$found_current)
			{
				echo '<a href="?controller=exercise&action=try_it&id=' . $exercise_id . '&lesson_id=' . $lesson->get_id() . '&concept_id=' . $concept->get_id() . '" class="tile btn btn-default"><span class="tile-number">' . $i . '</span><span class="tile-label">' . htmlspecialchars($lesson_props['name']) . '</span></a>';
				$found_current = true;
			}
			else
			{
				echo '<a class="tile btn btn-default disabled"><span class="tile-number">' . '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span><span class="sr-only">Locked</span>' . '</span></a>';
			}
		

			echo '</div>';
			$i++;
		}
	}
	echo '</div>';

?>
