<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SnapshotController extends Controller
{
    private $aliases = [
        'spots' => 'App/Spot',
    ];
    
    protected function getClass($key) {
        return $this->aliases[$key];
    }

    /**
     * Return a paginated list of snapshot for a model
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    protected function index($alias, $id)
    {
        return Snapshot::select('id', 'json')->where([
            'model' => self::getClass($alias),
            'key' => $id
        ])->paginate();
    }

    /**
     * Restore from snapshot
     *
     * @param  Request  $request
     * @return App\Spot
     */
    protected function restore(Request $request)
    {
        $snapshot = Snapshot::where($request->toArray())->firstOrFail();
        
        if(class_exists($snapshot->model)){
            return $snapshot->model::create( $snapshot->json() );
        }

        return ['created' => false];
    }
    
}
