<?php

namespace Wainwright\CasinoDogOperatorApi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wainwright\CasinoDogOperatorApi\Commands\InstallCasinoDogOperator;
use Wainwright\CasinoDogOperatorApi\Commands\SyncGameslist;
use Wainwright\CasinoDogOperatorApi\Commands\PlayerFundTransferCommand;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class CasinoDogOperatorApiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('casino-dog-operator-api')
            ->hasConfigFile()
            ->hasViews('wainwright')
            ->hasRoutes(['api', 'web'])
            ->hasMigrations(['create_operator_disabled_games_table', 'create_casino_profiles_table', 'create_playerbalances_table', 'create_operator_gameslist_table'])
            ->hasCommands(PlayerFundTransferCommand::class, InstallCasinoDogOperator::class, SyncGameslist::class);
            $kernel = app(\Illuminate\Contracts\Http\Kernel::class);

            //Register the proxy
            $this->app->bind('ProxyHelper', function($app) {
                return new ProxyHelper();
            });

            Http::macro('dog_api', function ($dog_method = NULL) {
                if($dog_method !== NULL) {
                    return Http::withHeaders(['operator_key' => config('casino-dog-operator-api.access.key')])->baseUrl(config('casino-dog-operator-api.endpoints.'.$dog_method));
                } else {
                    return Http::baseUrl(config('casino-dog-operator-api.api_url'));
                }
            });


    }
}

