<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class TransformerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $fractal = $this->app->make(Manager::class);

        response()->macro('item', function ($item, TransformerAbstract $transformer, $status = 200, array $headers = []) use ($fractal) {
            $resource = new Item($item, $transformer);

            return response()->json(
                $fractal->createData($resource)->toArray(),
                $status,
                $headers
            );
        });

        response()->macro('collection', function ($collection, TransformerAbstract $transformer, $status = 200, array $headers = []) use ($fractal) {
            $resource = new Collection($collection, $transformer);

            return response()->json(
                $fractal->createData($resource)->toArray(),
                $status,
                $headers
            );
        });

        response()->macro('jsonError', function ($msg, $status = 200, array $headers = []) use ($fractal) {
            $data = new \stdClass();
            $data->message = $msg;
            $data->code = 0;
            return response()->json(
                $data,
                $status,
                $headers
            );
        });

        response()->macro('jsonOk', function ($data, $status = 200, array $headers = []) use ($fractal) {
            $dataRes = new \stdClass();
            $dataRes->data = $data;
            $dataRes->code = 1;
            return response()->json(
                $dataRes,
                $status,
                $headers
            );
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Manager::class, function($app) {
            $manager = new Manager;
            return $manager;
        });
    }
}
