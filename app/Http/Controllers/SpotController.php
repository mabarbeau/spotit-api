<?php

namespace App\Http\Controllers;

use App\Spot;
use App\Snapshot;
use App\Http\Requests\StoreSpot;

class SpotController extends Controller
{
    /**
     * Return a paginated list of spots
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    protected function index()
    {
        return Spot::select(['title', 'slug'])->paginate();
    }

    /**
     * Store a newly created spot in storage.
     *
     * @param  App\Http\Requests\StoreSpot  $request
     * @return App\Spot
     */
    protected function store(StoreSpot $request)
    {
        return Spot::create($request->all());
    }

    /**
     * Display the specified spot.
     *
     * @param  string $slug
     * @return App\Spot
     */
    protected function show($slug)
    {
        return Spot::where('slug', $slug)->firstOrFail();
    }

    /**
     * Update the specified spot in storage.
     *
     * @param  App\Http\Requests\StoreSpot  $request
     * @param  string $slug
     * @return App\Spot
     */
    public function update(StoreSpot $request, $slug)
    {
        $spot = Spot::where('slug', $slug)->firstOrFail();

        Snapshot::create($spot);

        return [
            'updated' => $spot->update($request->all()) 
        ];
    }
    
    /**
     * Remove the specified spot from storage.
     *
     * @param  string $slug
     * @return Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $spot = Spot::where('slug', $slug)->firstOrFail();

        Snapshot::create($spot);
            
        return [
            'deleted' =>  $spot->delete()
        ];
    }
}