<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SupController extends Controller
{
    
    public function create() {
        return view('pengirim.add');
        }
        public function store(Request $request) {
        $request->validate([
        'ID_PENGIRIM' => 'required',
        'NAMA_PENGIRIM' => 'required',
        'ALAMAT_PENGIRIM' => 'required',
        'NOMOR_PENGIRIM' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO pengirim (ID_PENGIRIM,NAMA_PENGIRIM,
        ALAMAT_PENGIRIM, NOMOR_PENGIRIM) VALUES
        (:ID_PENGIRIM, :NAMA_PENGIRIM, :ALAMAT_PENGIRIM, :NOMOR_PENGIRIM)',
        [
        'ID_PENGIRIM' => $request->ID_PENGIRIM,
        'NAMA_PENGIRIM' => $request->NAMA_PENGIRIM,
        'ALAMAT_PENGIRIM' => $request->ALAMAT_PENGIRIM,
        'NOMOR_PENGIRIM' => $request->NOMOR_PENGIRIM,
        ]
        );
        return redirect()->route('pengirim.index')->with('success', 'Data Pengirim berhasil disimpan');
        }
    
        public function index(Request $request) {
            if ($request->has('search')){
                $datas = DB::select('SELECT * FROM pengirim WHERE is_delete = 0 and NAMA_PENGIRIM = :search;',[
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
                $data = DB::table('pengirim')->where('ID_PENGIRIM',
                $id)->first();
                return view('pengirim.edit')->with('data', $data);
                }
                public function update($id, Request $request) {
                $request->validate([
                'ID_PENGIRIM' => 'required',
                'NAMA_PENGIRIM' => 'required',
                'ALAMAT_PENGIRIM' => 'required',
                'NOMOR_PENGIRIM' => 'required',
                ]);
                // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                DB::update('UPDATE pengirim SET ID_PENGIRIM =
                :ID_PENGIRIM, NAMA_PENGIRIM = :NAMA_PENGIRIM, ALAMAT_PENGIRIM = :ALAMAT_PENGIRIM, NOMOR_PENGIRIM = :NOMOR_PENGIRIM WHERE ID_PENGIRIM=:id',
                [
                'id' => $id,
                'ID_PENGIRIM' => $request->ID_PENGIRIM,
                'NAMA_PENGIRIM' => $request->NAMA_PENGIRIM,
                'ALAMAT_PENGIRIM' => $request->ALAMAT_PENGIRIM,
                'NOMOR_PENGIRIM' => $request->NOMOR_PENGIRIM,
                ]
                );
                return redirect()->route('pengirim.index')->with('success', 'Data Pengirim berhasil diubah');
                }

                public function delete($id) {
                    // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                    DB::delete('DELETE FROM pengirim WHERE ID_PENGIRIM =
                    :ID_PENGIRIM', ['ID_PENGIRIM' => $id]);
                    return redirect()->route('pengirim.index')->with('success', 'Data Pengirim berhasil dihapus');
                    }

                    public function soft($id)
                    {
                        DB::update('UPDATE pengirim SET is_delete = 1 WHERE ID_PENGIRIM = :ID_PENGIRIM', ['ID_PENGIRIM' => $id]);

                        return redirect()->route('pengirim.index')->with('success', 'Data Pengirim berhasil dihapus');
                    }
}
