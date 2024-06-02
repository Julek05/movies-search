<?php

declare(strict_types=1);

namespace tests\Services\Strategy;

use App\Services\Provider\MoviesProviderInterface;
use App\Services\Strategy\RandomSearchStrategy;
use PHPUnit\Framework\TestCase;

class RandomSearchStrategyTest extends TestCase
{
    /**
     * @param string[] $movies
     * @dataProvider provider
     */
    public function test_execute(array $movies): void
    {
        $mockedMoviesProvider = $this->createMock(MoviesProviderInterface::class);
        $mockedMoviesProvider->method('provide')->willReturn($movies);

        $testClass = new RandomSearchStrategy($mockedMoviesProvider);

        $result = $testClass->execute();

        $this->assertCount(3, array_unique($result));

        foreach ($result as $filmName) {
            $this->assertIsString($filmName);
        }
    }

    public function provider(): array
    {
        return [
            [
                [
                    "Leon zawodowiec",
                    "Nietykalni",
                    "Władca Pierścieni: Powrót króla",
                    "Chłopaki nie płaczą",
                    "Człowiek z blizną",
                    "Pianista",
                    "Doktor Strange",
                    "Szeregowiec Ryan"
                ]
            ],
            [
                [
                    "Wyspa tajemnic",
                    "Django",
                    "American Beauty",
                    "Szósty zmysł",
                    "Gwiezdne wojny: Nowa nadzieja",
                    "Mroczny Rycerz",
                    "Władca Pierścieni: Drużyna Pierścienia",
                    "Harry Potter i Kamień Filozoficzny",
                    "Green Mile"
                ]
            ],
        ];
    }
}