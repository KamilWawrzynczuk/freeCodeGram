<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfilesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(\App\Models\User $user)
    {

        return view('profiles.index', compact('user'));
    }

    public function edit(\App\Models\User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

     public function update(\App\Models\User $user)
    {

        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);


        if( request('image') ) {

            // store image in uploads directory and second parametr is driver to store our file like 's3' but we have public
            $imagePath =  request('image')->store('storage', 'public');

            $user->profile->update(array_merge(
                $data,
                ['image' => $imagePath]
            ));

        } else {
           $user->profile->update($data);
        }

        return redirect("/profile/{$user->id}");
    }
}
