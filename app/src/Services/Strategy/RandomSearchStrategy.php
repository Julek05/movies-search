<?php

declare(strict_types=1);

namespace App\Services\Strategy;

use App\Services\Provider\MoviesProviderInterface;

final class RandomSearchStrategy implements SearchStrategyInterface
{
    private const int FILMS_AMOUNT = 3;

    public function __construct(private readonly MoviesProviderInterface $moviesProvider)
    {
    }

    public function execute(): array
    {
        $allMovies = $this->moviesProvider->provide();

        return array_rand(array_flip(array_unique($allMovies)), self::FILMS_AMOUNT);
    }
}