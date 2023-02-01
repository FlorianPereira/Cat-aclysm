<?php

namespace App\Factory;

use App\Entity\Playlist;
use App\Repository\CatAclysmRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Playlist>
 *
 * @method        Playlist|Proxy create(array|callable $attributes = [])
 * @method static Playlist|Proxy createOne(array $attributes = [])
 * @method static Playlist|Proxy find(object|array|mixed $criteria)
 * @method static Playlist|Proxy findOrCreate(array $attributes)
 * @method static Playlist|Proxy first(string $sortedField = 'id')
 * @method static Playlist|Proxy last(string $sortedField = 'id')
 * @method static Playlist|Proxy random(array $attributes = [])
 * @method static Playlist|Proxy randomOrCreate(array $attributes = [])
 * @method static CatAclysmRepository|RepositoryProxy repository()
 * @method static Playlist[]|Proxy[] all()
 * @method static Playlist[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Playlist[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Playlist[]|Proxy[] findBy(array $attributes)
 * @method static Playlist[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Playlist[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PlaylistFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'title' => self::faker()->words(5, true),
            'description' => self::faker()->paragraph(),
            'trackCount' => self::faker()->numberBetween(5, 40),
            'genre' => self::faker()->randomElement(['House', 'Metal', 'LoFi', 'Breakbeat', 'Drum&Bass']),
            'votes' => self::faker()->numberBetween(-50, 100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Playlist $playlist): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Playlist::class;
    }
}
