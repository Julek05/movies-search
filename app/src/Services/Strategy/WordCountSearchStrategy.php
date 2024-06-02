<?php

declare(strict_types=1);

namespace App\Services\Strategy;

use App\Services\Provider\MoviesProviderInterface;

final class WordCountSearchStrategy implements SearchStrategyInterface
{
    private const int MINIMUM_WORD_COUNT = 2;

    public function __construct(private readonly MoviesProviderInterface $moviesProvider)
    {
    }

    public function execute(): array
    {
        $movies = array_unique($this->moviesProvider->provide());

        return $this->convertToList(
            array_filter($movies, fn(string $movie) => count(explode(' ', $movie)) >= self::MINIMUM_WORD_COUNT)
        );
    }

    private function convertToList(array $movies): array
    {
        return [...$movies];
    }
}
