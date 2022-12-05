<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PengirimController extends Controller
{
    
    public function create() {
        return view('pengirim.add');
        }
        public function store(Request $request) {
        $request->validate([
        'id_pengirim' => 'required',
        'nama_pengirim' => 'required',
        'alamat_pengirim' => 'required',
        'nomor_pengirim' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO pengirim (id_pengirim,nama_pengirim,
        alamat_pengirim, nomor_pengirim) VALUES
        (:id_pengirim, :nama_pengirim, :alamat_pengirim, :nomor_pengirim)',
        [
        'id_pengirim' => $request->id_pengirim,
        'nama_pengirim' => $request->nama_pengirim,
        'alamat_pengirim' => $request->alamat_pengirim,
        'nomor_pengirim' => $request->nomor_pengirim,
        ]
        );
        return redirect()->route('pengirim.index')->with('success', 'Data Pengirim berhasil disimpan');
        }
    
        public function index(Request $request) {
            if ($request->has('search')){
                $datas = DB::select('SELECT * FROM pengirim WHERE is_delete = 0 and nama_pengirim = :search;',[
                'search'=>$request->search
                
            ]);
            return view('pengirim.index')
            
            ->with('datas', $datas);
            } else {
                $datas = DB::select('SELECT * FROM pengirim WHERE is_delete = 0');
            return view('pengirim.index')
            
            ->with('datas', $datas);
            }
            }

            public function edit($id) {
                $data = DB::table('pengirim')->where('id_pengirim',
                $id)->first();
                return view('pengirim.edit')->with('data', $data);
                }
                public function update($id, Request $request) {
                $request->validate([
                'id_pengirim' => 'required',
                'nama_pengirim' => 'required',
                'alamat_pengirim' => 'required',
                'nomor_pengirim' => 'required',
                ]);
                // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                DB::update('UPDATE pengirim SET id_pengirim =
                :id_pengirim, nama_pengirim = :nama_pengirim, alamat_pengirim = :alamat_pengirim, nomor_pengirim = :nomor_pengirim WHERE id_pengirim=:id',
                [
                'id' => $id,
                'id_pengirim' => $request->id_pengirim,
                'nama_pengirim' => $request->nama_pengirim,
                'alamat_pengirim' => $request->alamat_pengirim,
                'nomor_pengirim' => $request->nomor_pengirim,
                ]
                );
                return redirect()->route('pengirim.index')->with('success', 'Data Pengirim berhasil diubah');
                }

                public function delete($id) {
                    // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                    DB::delete('DELETE FROM pengirim WHERE id_pengirim =
                    :id_pengirim', ['id_pengirim' => $id]);
                    return redirect()->route('pengirim.index')->with('success', 'Data Pengirim berhasil dihapus');
                    }

                    public function soft($id)
                    {
                        DB::update('UPDATE pengirim SET is_delete = 1 WHERE id_pengirim = :id_pengirim', ['id_pengirim' => $id]);

                        return redirect()->route('pengirim.index')->with('success', 'Data Pengirim berhasil dihapus');
                    }
}
