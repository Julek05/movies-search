<?php

declare(strict_types=1);

namespace App\Services\Factory;

use App\Enum\SearchType;
use App\Services\Provider\MoviesProviderInterface;
use App\Services\Strategy\CharacterSearchStrategy;
use App\Services\Strategy\RandomSearchStrategy;
use App\Services\Strategy\SearchStrategyInterface;
use App\Services\Strategy\WordCountSearchStrategy;
use InvalidArgumentException;

final readonly class SearchFactory
{
    public function __construct(private MoviesProviderInterface $moviesProvider)
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function make(SearchType $searchType): SearchStrategyInterface
    {
        return match ($searchType) {
            SearchType::RANDOM => new RandomSearchStrategy($this->moviesProvider),
            SearchType::CHARACTER => new CharacterSearchStrategy($this->moviesProvider),
            SearchType::WORD_COUNT => new WordCountSearchStrategy($this->moviesProvider),

            default => throw new InvalidArgumentException(
                sprintf('Search strategy for %s type does not exists', get_class($searchType))
            ),
        };
    }
}