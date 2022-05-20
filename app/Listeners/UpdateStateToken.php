<?php

namespace App\Listeners;

use App\Events\RegisteredByApi;
use App\Services\TokenService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class UpdateStateToken
 * @package App\Listeners
 */
class UpdateStateToken
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RegisteredByApi  $event
     * @return void
     */
    public function handle(RegisteredByApi $event)
    {
        /** @var TokenService $tokenService */
        $tokenService = app()->make(TokenService::class);
        $tokenFromBase = $tokenService->getTokenFromBase($event->token);

        if ($tokenFromBase) {
            $tokenService->setUsed($tokenFromBase);
        }
    }
}
