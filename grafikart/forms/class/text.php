<?php

class Text
{
	const SUFFIX = " $";

	public static function withZero($chiffre)
	{
		if ($chiffre <= 9)
			return '0' . $chiffre . self::SUFFIX;
		else
			return $chiffre . self::SUFFIX;
	}
}

?>