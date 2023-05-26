<?php

namespace App\Http\Controllers\Api;

use App\Http\Utils\Response;
use App\Models\Laporan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPUnit\Framework\isNull;

class LaporanController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = Laporan::all()->load('pemasukan', 'pengeluaran', 'pemasukan.user');

        return  $this->responseData($laporan, 'success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $laporan = $request->validate([
            'keterangan' => 'required',
            'pemasukan_id' => 'required',
            'pengeluaran_id' => 'required',
        ]);

        $laporan = Laporan::create($laporan);

        return  $this->responseData($laporan, 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laporan = Laporan::whereId($id)->first();

        if ($laporan == null) {
            return $this->responseDataNotFound('Laporan', isNull($laporan));
        }

        return  $this->responseData($laporan, 'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
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

        $laporan = Laporan::whereId($id)->first();

        if ($laporan == null) {
            return $this->responseDataNotFound('Laporan Tidak ditemukan', isNull($laporan));
        }

        $laporan = $laporan->update($request->all());

        return $this->responseData($laporan,'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan, $id)
    {
        $laporan = Laporan::where('id', $id)->first();

        if ($laporan == null) {
            return $this->responseDataNotFound('Laporan Tidak ditemukan',isNull($laporan));
        }

        $laporan = $laporan->delete();

        return $this->responseData($laporan,'success');
    }
}
