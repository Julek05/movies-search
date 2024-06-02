<?php

declare(strict_types=1);

namespace App\Services\Strategy;

interface SearchStrategyInterface
{
    /**
     * @return string[]
     */
    public function execute(): array;
}