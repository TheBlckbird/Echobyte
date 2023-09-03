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
    public function index(Request $request)
    {
        $raves = Rave::select('id', 'user_id', 'body', 'created_at')
            ->withCount($this->getCountsToLoad())
            ->where('parent_rave_id', null)
            ->whereNot('original_rave_id', null)
            ->with([
                'user:id,name',
                'originalRave:id,user_id,body',
                'originalRave.user:id,name',
            ])
            ->latest()
            ->simplePaginate(12);

        dump($raves);

        $raves->transform(function ($rave) {
            return $this->loadAdditionalRaveProperties($rave);
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
        $request->user()->raves()->create($request->validated());

        return redirect()->route('raves.index');
    }

    public function storeComment(StoreRaveRequest $request, Rave $rave)
    {
        $comment = new Rave($request->validated());
        $comment->user()->associate($request->user());
        $rave->comments()->save($comment);

        return back()->withMessage('Comment posted.');
    }

    public function storeRerave(StoreRaveRequest $request, Rave $rave)
    {
        $comment = new Rave($request->validated());
        $comment->user()->associate($request->user());
        $rave->reraves()->save($comment);

        return back()->withMessage('Rerave posted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Rave $rave)
    {
        $rave
            ->load([
                'user:id,name',
                'comments:id,parent_rave_id,user_id,body,created_at',
                'comments.user:id,name',
                'reraves:id,original_rave_id,user_id,body,created_at',
                'reraves.user:id,name',
                'originalRave:id,user_id,body',
                'originalRave.user:id,name',
            ])
            ->loadCount($this->getCountsToLoad(true));

        $rave = $this->loadAdditionalRaveProperties($rave);
        $rave->comments->loadCount($this->getCountsToLoad());
        $rave->reraves->loadCount($this->getCountsToLoad());

        $rave->comments->transform(function ($comment) {
            return $this->loadAdditionalRaveProperties($comment);
        });

        $rave->reraves->transform(function ($rerave) {
            return $this->loadAdditionalRaveProperties($rerave);
        });

        return inertia('Raves/Show', [
            'rave' => $rave,
        ]);
    }

    private function getCountsToLoad(bool $standalone = false): array
    {
        $countsToLoad = [
            'usersLiked as likes_count',
        ];

        if (! $standalone) {
            $countsToLoad = array_merge($countsToLoad, [
                'comments',
                'reraves',
            ]);
        }

        return $countsToLoad;
    }

    private function loadAdditionalRaveProperties(Rave $rave): Rave
    {
        $rave['is_owner'] = $rave->user_id === auth()->id();
        $rave['is_liked'] = $rave->usersLiked()
            ->where('user_id', auth()->id())
            ->exists();

        return $rave;
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
     * Toggle the like status of the Rave for the user
     */
    public function toggleLike(Request $request, Rave $rave)
    {
        $request->user()->likedRaves()->toggle($rave);

        // return json_encode([
        //     'likes_count' => $rave->likes_count,
        // ]);
    }

    public function rerave(StoreRaveRequest $request, Rave $rave)
    {
        $rerave = new Rave($request->validated());
        $rerave->user()->associate($request->user());
        $rave->reraves()->save($rerave);

        return back()->withMessage('Reraved.');
    }
}
