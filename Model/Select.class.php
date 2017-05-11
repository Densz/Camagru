<?php
class Select
{

	public function		select_all($table)
	{
		return (Dispatcher::$db->query("SELECT * FROM " . $table));
	}

	public function spe_select($value, $table, $condition = null)
	{
		$request = "SELECT " . $value . " FROM " . $table;
		if ($condition)
		{
			$request .= " WHERE ";
			foreach ($condition as $k => $v)
				$request .= $k . ' = ' . $v . ' AND ';
			$request = substr($request, 0, -5);
		}
		return (Dispatcher::$db->query($request));
	}
}

?>