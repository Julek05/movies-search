<?php

declare(strict_types=1);

namespace tests\Services\Factory;

use App\Enum\SearchTypeEnum;
use App\Services\Factory\SearchFactory;
use App\Services\Provider\MoviesProvider;
use App\Services\Strategy\CharacterSearchStrategy;
use App\Services\Strategy\RandomSearchStrategy;
use App\Services\Strategy\WordCountSearchStrategy;
use PHPUnit\Framework\TestCase;

class SearchFactoryTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function test_make(SearchTypeEnum $searchType, string $expectedSearchStrategyClassName): void
    {
        $testClass = new SearchFactory(new MoviesProvider());

        $this->assertInstanceOf($expectedSearchStrategyClassName, $testClass->make($searchType));
    }

    public function provider(): array
    {
        return [
            [SearchTypeEnum::RANDOM, RandomSearchStrategy::class],
            [SearchTypeEnum::CHARACTER, CharacterSearchStrategy::class],
            [SearchTypeEnum::WORD_COUNT, WordCountSearchStrategy::class],
        ];
    }
}