<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use View;
use App\Repositories\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\LessonRepository;
use App\Repositories\Lesson\LessonRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserRepositoryInterface::class, UserRepository::class);
        App::bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        App::bind(LessonRepositoryInterface::class, LessonRepository::class);
    }
}
