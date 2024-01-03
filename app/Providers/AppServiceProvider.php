<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\Interfaces\BaseRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Base
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);

        // Usuario
        $this->app->bind(\Modules\Usuario\Repositories\Interfaces\UsuarioRepositoryInterface::class, \Modules\Usuario\Repositories\UsuarioRepository::class);
        $this->app->bind(\Modules\Usuario\Services\Interfaces\UsuarioServiceInterface::class, \Modules\Usuario\Services\UsuarioService::class);

        // Tag
        $this->app->bind(\Modules\Tag\Repositories\Interfaces\TagRepositoryInterface::class, \Modules\Tag\Repositories\TagRepository::class);
        $this->app->bind(\Modules\Tag\Services\Interfaces\TagServiceInterface::class, \Modules\Tag\Services\TagService::class);

        // Tag
        $this->app->bind(\Modules\Tag\Repositories\Interfaces\TagRepositoryInterface::class, \Modules\Tag\Repositories\TagRepository::class);
        $this->app->bind(\Modules\Tag\Services\Interfaces\TagServiceInterface::class, \Modules\Tag\Services\TagService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
