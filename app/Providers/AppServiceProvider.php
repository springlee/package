<?php

namespace App\Providers;


use App\Exceptions\InvalidRequestException;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Imports\HeadingRowExtractor;
use Maatwebsite\Excel\Reader;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        Reader::listen(BeforeImport::class, function (BeforeImport $event) {
            $concernable = $event->getConcernable();
            if ($concernable->verifyHeader) {
                $header = array_filter(HeadingRowExtractor::extract($event->getDelegate()->getDelegate()->getActiveSheet(), $concernable));
                if($header!=$concernable->header){
                    throw new InvalidRequestException('表格模板不正确');
                }
            }
        });
    }
}
