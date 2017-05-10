<?php

class CB
{
	public static function my_assert($str)
	{
		if (isset($str) && !empty($str))
			return (1);
		return (0);
	}
}

?>