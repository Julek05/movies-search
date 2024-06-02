<?php

declare(strict_types=1);

namespace Tests\Services\Strategy;

use App\Services\Provider\MoviesProviderInterface;
use App\Services\Strategy\WordCountSearchStrategy;
use PHPUnit\Framework\TestCase;

class WordCountSearchStrategyTest extends TestCase
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

        $testClass = new WordCountSearchStrategy($mockedMoviesProvider);

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
                [
                    "Leon zawodowiec",
                    "Władca Pierścieni: Powrót króla",
                    "Chłopaki nie płaczą",
                    "Człowiek z blizną",
                    "Doktor Strange",
                    "Szeregowiec Ryan",
                ]
            ],
            [
                [
                    "Nietykalni",
                    "Pianista",
                    "Nędznicy",
                    "Seksmisja",
                    "Pachnidło",
                    "Iniemamocni",
                ],
                []
            ],
            [
                [
                    "Szczęki",
                    "Milczenie owiec",
                    "Dzień świra",
                    "Blade Runner",
                    "Labirynt",
                    "Król Lew",
                    "La La Land",
                    "Whiplash",
                    "Wyspa tajemnic",
                    "Django",
                    "American Beauty",
                    "Szósty zmysł",
                    "Gwiezdne wojny: Nowa nadzieja",
                    "Mroczny Rycerz",
                ],
                [
                    "Milczenie owiec",
                    "Dzień świra",
                    "Blade Runner",
                    "Król Lew",
                    "La La Land",
                    "Wyspa tajemnic",
                    "American Beauty",
                    "Szósty zmysł",
                    "Gwiezdne wojny: Nowa nadzieja",
                    "Mroczny Rycerz",
                ]
            ],
        ];
    }
}
