<?php
class Update
{
	public function update_value($table, $set, $condition)
	{
		$request = "UPDATE " . $table . " SET ";
		foreach ($set as $k => $v)
			$request .= $k . ' = ' . $v . ', ';
		$request = substr($request, 0, -2);
		if (CB::my_assert($condition))
		{
			$request .= ' WHERE ';
			foreach ($condition as $k => $v)
				$request .= $k . ' = ' . $v . ' AND ';
			$request = substr($request, 0, -5);
		}
		return (Dispatcher::$db->query($request));
	}
}