<?php

namespace App\Http\Controllers\Api;

use App\Http\Utils\Response;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPUnit\Framework\isNull;


class PengeluaranController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::all();

        return  $this->responseData($pengeluaran, 'success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengeluaran = $request->validate([
            'nm_pengeluaran' => 'required',
            'jumlah' => 'required',
            'catatan' => 'required',
            'user_id' => 'required'
        ]);

        $pengeluaran = Pengeluaran::create($pengeluaran);

        return  $this->responseData($pengeluaran, 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengeluaran = Pengeluaran::whereId($id)->first();

        if ($pengeluaran == null) {
            return $this->responseDataNotFound('Pengeluaran', isNull($pengeluaran));
        }

        return  $this->responseData($pengeluaran, 'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nm_pengeluaran' => 'required',
            'jumlah' => 'required',
            'catatan' => 'required',
            'user_id' => 'required'
        ]);

        $pengeluaran = Pengeluaran::whereId($id)->first();

        if ($pengeluaran == null) {
            return $this->responseDataNotFound('Pengeluaran Tidak ditemukan', isNull($pengeluaran));
        }

        $pengeluaran = $pengeluaran->update($request->all());

        return response()
            ->json(['status' => 'true', 'message' => 'success' ,'data' => $request->all() ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::where('id', $id)->first();

        if ($pengeluaran == null) {
            return $this->responseDataNotFound('Pengeluaran Tidak ditemukan',isNull($pengeluaran));
        }

        $pengeluaran = $pengeluaran->delete();

        return $this->responseData($pengeluaran,'success');
    }
}
