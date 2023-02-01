<?php

namespace App\Listeners;

use App\Events\ModelUpdated;
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
