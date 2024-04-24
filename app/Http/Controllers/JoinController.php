<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJoinRequest;
use App\Models\Join;
use App\Traits\Public\PublicResourceTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JoinController extends Controller
{
    use PublicResourceTrait;

    /**
     * Display the create join page.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->create_resource('Join');
    }

    public function store(StoreJoinRequest $request)
    {
        $request->validated();

        Join::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'age' => $request->age,
            'phone' => $request->phone,
            'message' => $request->message ?? '',
        ]);

        return redirect()->back()->with('message', 'Formularul a fost trimis cu succes. Va multumim!');
    }
}
