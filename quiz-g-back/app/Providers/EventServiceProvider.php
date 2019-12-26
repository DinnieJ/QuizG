<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Quiz;
use App\Observers\QuizObserver;
use App\Collection;
use App\Observers\CollectionObserver;
use App\History;
use App\Observers\HistoryObserver;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Quiz::observe(new QuizObserver);
        Collection::observe(new CollectionObserver);
        History::observe(new HistoryObserver);
    }
}
