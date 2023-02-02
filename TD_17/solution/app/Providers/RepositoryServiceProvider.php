<?php

namespace App\Providers;

use App\Attributes\Repository;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $repositoriesClasses = $this->getRepositoriesClasses(app_path('Repositories/*.php'));

        foreach ($repositoriesClasses as $repositoriesClass) {
            $reflection = new ReflectionClass($repositoriesClass);
            foreach ($reflection->getAttributes(Repository::class) as $repositoryAttribute) {
                /** @var Repository $instance */
                $instance = $repositoryAttribute->newInstance();

                $modelClass = $instance->getModel();
                $model = new $modelClass();

                $this->app->singleton($instance->getInterface(), fn () => $reflection->newInstance($model));
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    private function getRepositoriesClasses(string $repositoriesPath)
    {
        return array_map(function ($repositoriesFiles) {
            $pathParts = explode(DIRECTORY_SEPARATOR, $repositoriesFiles);
            $pathParts = array_slice($pathParts, -3);
            $className = array_pop($pathParts);
            $className = str_replace('.php', '', $className);
            $pathParts[0] = ucfirst($pathParts[0]);

            return implode('\\', $pathParts).'\\'.$className;
        }, glob($repositoriesPath));
    }
}
