<?php

declare(strict_types=1);

namespace tests\Services\Strategy;

use App\Services\Provider\MoviesProviderInterface;
use App\Services\Strategy\CharacterSearchStrategy;
use PHPUnit\Framework\TestCase;

class CharacterSearchStrategyTest extends TestCase
{
    /**
     * @param string[] $movies
     * @param string[] $expectedResult
     * @dataProvider provider
     */
    public function test_execute(array $movies, array $expectedResult): void
    {
        $mockedMoviesProvider = $this->createMock(MoviesProviderInterface::class);
        $mockedMoviesProvider->method('provide')->willReturn($movies);

        $testClass = new CharacterSearchStrategy($mockedMoviesProvider);

        $this->assertEqualsCanonicalizing($expectedResult, $testClass->execute());
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
                ],
                []
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
                ],
                [
                    "Wyspa tajemnic",
                    "Władca Pierścieni: Drużyna Pierścienia",
                ]
            ],
            [
                [
                    "Wojownik",
                    "Wyspa tajemnic",
                    "Wielki Gatsby",
                    "Władca Pierścieni: Drużyna Pierścienia",
                    "Wojna Światów",
                    "Wojownik",
                    "W",
                    "Walkiria",
                    "Walkiria",
                ],
                [
                    "Wyspa tajemnic",
                    "Władca Pierścieni: Drużyna Pierścienia",
                    "Wojownik",
                    "Walkiria"
                ]
            ],
        ];
    }
}
