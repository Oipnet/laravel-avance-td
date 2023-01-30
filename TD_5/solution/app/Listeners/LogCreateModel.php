<?php

namespace App\Listeners;

use App\Events\ModelCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogCreateModel
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ModelCreated  $event
     * @return void
     */
    public function handle(ModelCreated $event)
    {
        $model = $event->getModel();

        Log::info('Creation de l\'objet '.$model::class, ['id' => $model->id]);
    }
}
