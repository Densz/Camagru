<?php
class Select
{
	public function	all($table)
	{
		return (Dispatcher::$db->query("SELECT * FROM " . $table));
	}

	public function query_select($value, $table, $condition = null, $one = true)
	{
		$request = "SELECT " . $value . " FROM " . $table;
		if ($condition)
		{
			$request .= " WHERE ";
			foreach ($condition as $k => $v)
				$request .= $k . ' = ' . $v . ' AND ';
			$request = substr($request, 0, -5);
		}
		return (Dispatcher::$db->query($request, $one));
	}

	public function query_select_or($value, $table, $condition = null)
	{
		$request = "SELECT " . $value . " FROM " . $table;
		if ($condition)
		{
			$request .= " WHERE ";
			foreach ($condition as $k => $v)
				$request .= $k . ' = ' . $v . ' OR ';
			$request = substr($request, 0, -4);
		}
		return (Dispatcher::$db->query($request));
	}

/*	public function prepare_select($value, $table, $condition = null)
	{
		$request = "SELECT ? FROM ?";
		$attributes = '[$value, $table,';
		if ($condition)
		{
			$request .= " WHERE ";
			foreach ($condition as $k => $v)
			{
				$request .= '? = ? AND ';
				$attributes .=
			}
			$request = substr($request, 0, -5);
		}
		$attributes = substr($attributes, 0, -1);
		$attributes .= ']';
		return (Dispatcher::$db->prepare($request, [$value, $table, $condition]));
	}*/
}

?>