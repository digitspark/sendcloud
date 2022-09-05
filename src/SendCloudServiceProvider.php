<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 11/19/15
 * Time: 9:42 AM.
 */
namespace DigitSpark\Mail;

use Illuminate\Mail\MailManager;
use Illuminate\Support\ServiceProvider;

class SendCloudServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/config/services.php', 'services'
        );
        
        $this->app->resolving('mail.manager', function (MailManager $mm) {
            $mm->extend('sendcloud', function () {
                $api_user = $this->app->make('config')->get('services.sendcloud.api_user');
                $api_key = $this->app->make('config')->get('services.sendcloud.api_key');

                return new SendCloudTransport($api_user, $api_key);
            });
        });
    }

    public function boot()
    {
        
    }
}
