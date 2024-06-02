<?php

declare(strict_types=1);

namespace App\Services\Strategy;

use App\Services\Provider\MoviesProviderInterface;

final class CharacterSearchStrategy implements SearchStrategyInterface
{
    private const string REQUIRED_FIRST_CHARACTER = 'W';

    public function __construct(private readonly MoviesProviderInterface $moviesProvider)
    {
    }

    public function execute(): array
    {
        $filteredMovies = [];

        foreach (array_unique($this->moviesProvider->provide()) as $movie) {
            if ($this->achieveRequirements($movie)) {
                $filteredMovies[] = $movie;
            }
        }

        return $filteredMovies;
    }

    private function achieveRequirements(string $movie): bool
    {
        return str_starts_with($movie, self::REQUIRED_FIRST_CHARACTER) && strlen($movie) % 2 === 0;
    }
}
