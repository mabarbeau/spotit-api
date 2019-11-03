<?php

namespace App\Http\Controllers;

use App\Spot;
use App\Backup;
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
     * @param  Illuminate\Http\Request  $request
     * @param  string $slug
     * @return App\Spot
     */
    public function update(StoreSpot $request, $slug)
    {
        return [
            'updated' =>  Spot::where('slug', $slug)
                ->firstOrFail()
                ->update($request->all()) 
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

        // Backup::create($spot->toArray());
        //     'id' => spot->id,
        //     'class' => 'spots',
        //     'data' => json_encode($spot),
        return [
            'deleted' =>  $spot->delete()
        ];
    }
}
