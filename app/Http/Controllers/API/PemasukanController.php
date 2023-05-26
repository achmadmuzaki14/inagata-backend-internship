<?php

namespace App\Http\Controllers\Api;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Utils\Response;

use function PHPUnit\Framework\isNull;

class PemasukanController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukan = Pemasukan::all();

        return  $this->responseData($pemasukan, 'success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pemasukan = $request->validate([
            'nm_pemasukan' => 'required',
            'jumlah' => 'required',
            'catatan' => 'required',
            'user_id' => 'required'
        ]);

        $pemasukan = Pemasukan::create($pemasukan);

        return  $this->responseData($pemasukan, 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasukan $pemasukan, $id)
    {
        $pemasukan = Pemasukan::whereId($id)->first();

        if ($pemasukan == null) {
            return $this->responseDataNotFound('Pemasukan', isNull($pemasukan));
        }

        return  $this->responseData($pemasukan, 'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nm_pemasukan' => 'required',
            'jumlah' => 'required',
            'catatan' => 'required',
            'user_id' => 'required'
        ]);

        $pemasukan = Pemasukan::whereId($id)->first();

        if ($pemasukan == null) {
            return $this->responseDataNotFound('Pemasukan Tidak ditemukan', isNull($pemasukan));
        }

        $pemasukan = $pemasukan->update($request->all());

        return response()
            ->json(['status' => 'true', 'message' => 'success' ,'data' => $request->all() ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemasukan = Pemasukan::where('id', $id)->first();

        if ($pemasukan == null) {
            return $this->responseDataNotFound('Pemasukan Tidak ditemukan',isNull($pemasukan));
        }

        $pemasukan = $pemasukan->delete();

        return $this->responseData($pemasukan,'success');
    }
}
