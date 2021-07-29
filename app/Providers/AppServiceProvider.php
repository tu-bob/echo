<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
         * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blueprint::macro('userStamp', function () {
            $this->char('created_by_id', 26)->index()->nullable();
            $this->char('updated_by_id', 26)->index()->nullable();
            $this->char('deleted_by_id', 26)->index()->nullable();
        });

        Blueprint::macro('counters', function () {
            $this->unsignedBigInteger('view_count')->default(0);
            $this->unsignedBigInteger('play_count')->default(0);
            $this->unsignedBigInteger('download_count')->default(0);
        });

        Blueprint::macro('fileFields', function (){
            $this->string('path');
            $this->char('filename', 50);
            $this->char('original_filename', 255);
            $this->string('mime_type');
            $this->char('extension', 10);
            $this->string('hash');
        });

        Blueprint::macro('commonFields', function () {
            $this->char('id', 26)->primary();
            $this->timestamps();
            $this->softDeletes();
            $this->userStamp();
        });
    }
}
