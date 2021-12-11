<?php

use function PHPStan\Testing\assertType;

class HelloWorld
{
	public function doFoo()
	{
		assertType('array<int, string>|false', preg_split('/-/', '1-2-3'));
		assertType('array<int, string>|false', preg_split('/-/', '1-2-3', -1, PREG_SPLIT_NO_EMPTY));
		assertType('array<int, array{string, int<0, max>}>|false', preg_split('/-/', '1-2-3', -1, PREG_SPLIT_OFFSET_CAPTURE));
		assertType('array<int, array{string, int<0, max>}>|false', preg_split('/-/', '1-2-3', -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE));
	}

	/**
	 * @param string $pattern
	 * @param string $subject
	 * @param int $limit
	 * @param int $flags PREG_SPLIT_NO_EMPTY or PREG_SPLIT_DELIM_CAPTURE
	 * @return list<array{string, int}>
	 * @phpstan-return list<array{string, int<0, max>}>
	 */
	public static function splitWithOffset($pattern, $subject, $limit = -1, $flags = 0)
	{
		assertType('array<int, array{string, int<0, max>}>|false', preg_split($pattern, $subject, $limit, $flags | PREG_SPLIT_OFFSET_CAPTURE));
		assertType('array<int, array{string, int<0, max>}>|false', preg_split($pattern, $subject, $limit, PREG_SPLIT_OFFSET_CAPTURE | $flags));

		assertType('array<int, array{string, int<0, max>}>|false', preg_split($pattern, $subject, $limit, PREG_SPLIT_OFFSET_CAPTURE | $flags | PREG_SPLIT_NO_EMPTY));
	}
}
