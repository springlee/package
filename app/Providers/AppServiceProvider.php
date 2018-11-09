<?php

namespace App\Providers;


use App\Exceptions\InvalidRequestException;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Imports\HeadingRowExtractor;
use Maatwebsite\Excel\Reader;
use Monolog\Logger;
use Yansongda\Pay\Pay;


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
        Reader::listen(BeforeImport::class, function (BeforeImport $event) {
            $concernable = $event->getConcernable();
            if ($concernable->verifyHeader) {
                $header = array_filter(HeadingRowExtractor::extract($event->getDelegate()->getDelegate()->getActiveSheet(), $concernable));
                if($header!=$concernable->header){
                    throw new InvalidRequestException('表格模板不正确');
                }
            }
        });

        // 往服务容器中注入一个名为 alipay 的单例对象
        $this->app->singleton('alipay', function () {
            $config = config('pay.alipay');
            if (app()->environment() !== 'production') {
                $config['mode']         = 'dev';
                $config['log']['level'] = Logger::DEBUG;
                $config['notify_url'] = route('products.pay.notify');
                $config['return_url'] = route('products.pay.return');
            } else {
                $config['log']['level'] = Logger::WARNING;
                $config['notify_url'] = route('products.pay.notify');
                $config['return_url'] = route('products.pay.return');
            }
            return Pay::alipay($config);
        });
    }
}
