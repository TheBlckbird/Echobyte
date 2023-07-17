<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRaveRequest;
use App\Http\Requests\UpdateRaveRequest;
use App\Models\Rave;
use Illuminate\Http\Request;

class RaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raves = Rave::with('user:id,name')
            ->where('parent_rave_id', null)
            ->where('original_rave_id', null)
            ->select('id', 'user_id', 'body', 'likes_count', 'created_at')
            ->latest()
            ->simplePaginate(12);

        $raves->transform(function ($rave) {
            $rave['comments_count'] = $rave->comments()->count();
            $rave['reraves_count'] = $rave->reraves()->count();

            return $rave;
        });

        return inertia('Raves/Index', [
            'raves' => $raves,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRaveRequest $request)
    {
        $rave = $request->user()->raves()->create($request->validated());

        return redirect()->route('raves.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rave $rave)
    {
        $rave->load([
            'user:id,name',
            'comments:id,parent_rave_id,user_id,body,likes_count,created_at',
            'comments.user:id,name',
        ]);

        $rave['reraves_count'] = $rave->reraves()->count();

        return inertia('Raves/Show', [
            'rave' => $rave,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRaveRequest $request, Rave $rave)
    {
        $rave->update($request->validated());

        return back()->withMessage('Rave updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rave $rave)
    {
        $rave->delete();

        return redirect()->route('raves.index')->withMessage('Rave deleted.');
    }

    /**
     * Like the specified resource.
     */
    public function like(Request $request)
    {
        $request->user()->like($request->likeable());
    }

    public function unlike(Request $request)
    {
        $request->user()->unlike($request->likeable());
    }
}
