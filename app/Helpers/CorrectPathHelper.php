<?php

declare(strict_types=1);

namespace App\Helpers;

trait CorrectPathHelper
{
    public function correctPathForGet(string $path): string
    {
        return !str_ends_with($path, '?') ? $path . '?' : $path;
    }
}
