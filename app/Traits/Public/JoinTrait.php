<?php

namespace App\Traits\Public;

use App\Exceptions\PublicException;
use App\Models\Join;
use Exception;

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

        try {
            Join::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'phone' => $request->phone,
                'message' => $request->message ?? '',
            ]);

            return redirect()->back()->with('message', 'Formularul a fost trimis cu succes. Va multumim!');
        } catch (Exception $e) {
            throw new PublicException('Formularul nu a putut fi trimis. Va rugam sa incercati din nou.', $e->getCode());
        }
    }
}
