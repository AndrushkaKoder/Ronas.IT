<?php

namespace Tests\Unit;

use App\Helpers\CorrectPathHelper;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class CorrectUrlTest extends TestCase
{
    use CorrectPathHelper;

    public function test_that_function_correct_path_is_correct(): void
    {
        $str = Str::random(20);
        $this->assertTrue(!str_ends_with($str, '?'));
        $this->assertTrue(str_ends_with($this->correctPathForGet($str), '?'));
    }
}
