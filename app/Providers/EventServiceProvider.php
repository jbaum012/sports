<?php

namespace App\Providers;

use App\Events\UserCreated;
use App\Events\SportsBetUpdated;
use App\Listeners\ClearUserBetCache;
use App\Listeners\ClearGameListCache;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\ClearGameWinnerCache;
use App\Listeners\CreateBetForEachUser;
use App\Listeners\CreateBetsForNewUser;
use App\Listeners\ClearSportsTeamGameCache;
use App\Events\SportsGames\SportsGameCreated;
use App\Events\SportsGames\SportsGameUpdated;
use App\Events\SportsGames\SportsGameScoresUpdated;
use App\Listeners\Awards\BigBirdAward;
use App\Listeners\Awards\BigBrainAward;
use App\Listeners\Awards\LoneWolfAward;
use App\Listeners\Awards\TigerKingAward;
use App\Listeners\ClearBetsCache;
use App\Listeners\ClearResultsCache;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreated::class => [
            CreateBetsForNewUser::class
        ],
        SportsGameCreated::class => [
            ClearSportsTeamGameCache::class,
            CreateBetForEachUser::class,
            ClearGameListCache::class,
            ClearBetsCache::class,
        ],
        SportsGameUpdated::class => [
            ClearGameListCache::class,
            ClearSportsTeamGameCache::class,
            ClearBetsCache::class,
        ],
        SportsBetUpdated::class => [
            ClearUserBetCache::class,
        ],
        SportsGameScoresUpdated::class => [
            ClearResultsCache::class,
            ClearGameWinnerCache::class,
            ClearGameListCache::class,
            ClearSportsTeamGameCache::class,
            BigBirdAward::class,
            TigerKingAward::class,
            BigBrainAward::class,
            LoneWolfAward::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
