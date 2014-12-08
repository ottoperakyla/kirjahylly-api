<?php 
function getRandomValueFromTableColumn($table, $column)
{
	$vals = DB::table($table)->lists($column);
	return $vals[rand(0, count($vals) - 1)];
}