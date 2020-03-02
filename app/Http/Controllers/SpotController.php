<?php

namespace App\Http\Controllers;

use App\Spot;
use App\Http\Requests\StoreSpot;
use App\Http\Requests\UpdateSpot;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    protected function store(StoreSpot $request)
    {
        return Spot::create($request->all());
    }

    /**
     * Display the specified spot.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    protected function show($slug)
    {
        return Spot::where('slug', $slug)->with([
            'creator',
            'map',
            'features',
            'features.map',
            'sports:name'
        ])->firstOrFail();
    }

    /**
     * Update the specified spot in storage.
     *
     * @param  App\Http\Requests\UpdateSpot  $request
     * @param  App\Spot $spot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpot $request, Spot $spot)
    {
        $user = Auth::user();

        $spot->updates()->create([
            'data' => json_encode($request->getChanges()),
            'creator_id' => $user->id
        ]);

        return [
           'status' => 'success',
           'message' => 'Request to update spot created',
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
        
        $spot->delete();

        return [
            'status' => 'success',
            'message' => 'Spot deleted'
        ];
    }
}
