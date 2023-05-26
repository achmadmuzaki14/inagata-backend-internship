<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;
use App\Http\Controllers\Controller;
use App\Http\Utils\Response;

class ProfileController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::all();

        return  $this->responseData($profiles, 'success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $profile = $request->validate([
            'telepon' => 'required|string|max:155',
            'alamat' => 'required',
            'user_id' => 'required'
        ]);

        $profile = Profile::create($profile);

        return  $this->responseData($profile, 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Profile::with('user')->whereId($id)->first();

        if ($test == null) {
            return $this->responseDataNotFound('Profile', isNull($test));
        }

        return  $this->responseData($test, 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
       $request->validate([
            'telepon' => 'required',
            'alamat' => 'required',
            'user_id' => 'required'
        ]);

        $profile = Profile::whereId($id)->first();

        if ($profile == null) {
            return $this->responseDataNotFound('Profile Tidak ditemukan', isNull($profile));
        }

        $profile = $profile->update($request->all());

        return response()
            ->json(['status' => 'true', 'message' => 'success' ,'data' => $request->all() ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $profile = Profile::where('id', $id)->first();

        if ($profile == null) {
            return $this->responseDataNotFound('Profile Tidak ditemukan',isNull($profile));
        }

        $profile = $profile->delete();

        return $this->responseData($profile,'success');
    }
}
