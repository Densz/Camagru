<?php
class Insert
{
	public function insert_value($table, $values)
	{
		$request = "INSERT INTO " . $table . "(";
		foreach ($values as $k => $v)
			$request .= $k . ', ';
		$request = substr($request, 0, -2);
		$request .= ") VALUES (";
		foreach ($values as $k => $v)
			$request .= $v . ', ';
		$request = substr($request, 0, -2);
		$request .= ");";
		return (Dispatcher::$db->query($request));
	}
}