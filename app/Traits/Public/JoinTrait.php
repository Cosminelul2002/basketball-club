<?php

namespace App\Traits\Public;

use App\Models\Join;

trait JoinTrait
{
    /**
     * Store a newly created resource in storage for the join form.
     *
     * @param $request
     * @param $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_join($request)
    {
        $request->validated();

        Join::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'message' => $request->message ?? '',
        ]);

        return redirect()->back()->with('message', 'Formularul a fost trimis cu succes. Va multumim!');
    }
}
