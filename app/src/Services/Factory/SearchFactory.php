<?php

declare(strict_types=1);

namespace App\Services\Factory;

use App\Enum\SearchTypeEnum;
use App\Services\Provider\MoviesProviderInterface;
use App\Services\Strategy\CharacterSearchStrategy;
use App\Services\Strategy\RandomSearchStrategy;
use App\Services\Strategy\SearchStrategyInterface;
use App\Services\Strategy\WordCountSearchStrategy;
use InvalidArgumentException;

final class SearchFactory
{
    public function __construct(private readonly MoviesProviderInterface $moviesProvider)
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function make(SearchTypeEnum $searchType): SearchStrategyInterface
    {
        return match ($searchType) {
            SearchTypeEnum::RANDOM => new RandomSearchStrategy($this->moviesProvider),
            SearchTypeEnum::CHARACTER => new CharacterSearchStrategy($this->moviesProvider),
            SearchTypeEnum::WORD_COUNT => new WordCountSearchStrategy($this->moviesProvider),

            default => throw new InvalidArgumentException(
                sprintf('Search strategy for %s type does not exists', get_class($searchType))
            ),
        };
    }
}