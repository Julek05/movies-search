<?php

declare(strict_types=1);

namespace App\Services\Provider;

interface MoviesProviderInterface
{
    /**
     * @return string[]
     */
    public function provide(): array;
}