<?php

declare(strict_types=1);

use App\Services\Provider\MoviesProvider;
use App\Services\Strategy\RandomSearchStrategy;
use PHPUnit\Framework\TestCase;

class RandomSearchStrategyTest extends TestCase
{
    public function test_search(): void
    {
        $testClass = new RandomSearchStrategy(new MoviesProvider());

        $result = $testClass->execute();

        $this->assertCount(3, array_unique($result));

        foreach ($result as $filmName) {
            $this->assertIsString($filmName);
        }
    }
}