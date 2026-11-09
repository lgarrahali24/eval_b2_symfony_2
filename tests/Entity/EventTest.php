<?php

namespace App\Tests\Entity;

use App\Entity\Event;
use App\Entity\User;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    // Teste le calcul des places restantes selon le nombre d'inscrits.
    #[DataProvider('provideRemainingPlacesData')]
    public function testGetRemainingPlaces(int $totalPlaces, int $participantsCount, int $expectedRemaining): void
    {
        $event = new Event();
        $event->setPlaces($totalPlaces);

        for ($i = 0; $i < $participantsCount; $i++) {
            $event->addParticipant(new User());
        }

        $this->assertSame($expectedRemaining, $event->getRemainingPlaces());
    }

    // Fournit le cas de test pour les places restantes.
    public static function provideRemainingPlacesData(): array
    {
        return [
            'aucun inscrit' => [10, 0, 10],
            'quelques inscrits' => [10, 3, 7],
            'complet' => [5, 5, 0],
        ];
    }

    #[DataProvider('provideCategoryLabelData')]
    public function testGetCategoryLabel(string $categoryCode, string $expectedLabel): void
    {
        $event = new Event();
        $event->setCategory($categoryCode);

        $this->assertSame($expectedLabel, $event->getCategoryLabel());
    }

    public static function provideCategoryLabelData(): array
    {
        return [
            'Concert' => ['concert', 'Concert'],
            'Conférence' => ['conference', 'Conférence'],
            'Atelier' => ['atelier', 'Atelier'],
            'Sport' => ['sport', 'Sport'],
        ];
    }
}