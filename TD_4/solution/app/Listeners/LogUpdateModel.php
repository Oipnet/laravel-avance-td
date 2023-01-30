<?php

namespace App\Listeners;

use App\Events\ModelCreated;
use App\Events\ModelUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogUpdateModel
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ModelUpdated  $event
     * @return void
     */
    public function handle(ModelUpdated $event)
    {
        $model = $event->getModel();

        Log::info('Mise à jour de l\'objet '.$model::class.' : '.$model->id);
    }
}
