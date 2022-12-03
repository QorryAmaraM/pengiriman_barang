<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AdminController extends Controller
{
    
    public function create() {
        return view('admin.add');
        }
        public function store(Request $request) {
        $request->validate([
        'ID_PENGIRIM' => 'required',
        'ID_BARANG' => 'required',
        'ID_PENERIMA' => 'required',
        'NAMA_BARANG' => 'required',
        'JENIS' => 'required',
        'BERAT' => 'required',
        'TUJUAN' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO paket (ID_PENGIRIM,ID_BARANG,ID_PENERIMA,
        NAMA_BARANG, JENIS, BERAT, TUJUAN) VALUES
        (:ID_PENGIRIM, :ID_BARANG, :ID_PENERIMA, :NAMA_BARANG, :JENIS, :BERAT,
        :TUJUAN)',
        [
        'ID_PENGIRIM' => $request->ID_PENGIRIM,
        'ID_BARANG' => $request->ID_BARANG,
        'ID_PENERIMA' => $request->ID_PENERIMA,
        'NAMA_BARANG' => $request->NAMA_BARANG,
        'JENIS' => $request->JENIS,
        'BERAT' => $request->BERAT,
        'TUJUAN' => $request->TUJUAN,
        ]
        );
        return redirect()->route('admin.index')->with('success', 'Data Barang berhasil disimpan');
        }

        public function index(Request $request) {
            if ($request->has('search')){
                $datas = DB::select('SELECT B.ID_PENGIRIM, K.NAMA_PENGIRIM, B.NAMA_BARANG, B.JENIS, B.BERAT, B.TUJUAN
            FROM barang B LEFT JOIN pengirim K
            ON B.ID_PENGIRIM = K.ID_PENGIRIM WHERE B.is_delete = 0 and B.NAMA_BARANG = :search;',[
                'search'=>$request->search
                
            ]);
            return view('admin.index')
            
            ->with('datas', $datas);
            } else {
                $datas = DB::select('SELECT B.ID_PENGIRIM, K.NAMA_PENGIRIM, B.NAMA_BARANG, B.JENIS, B.BERAT, B.TUJUAN
            FROM barang B LEFT JOIN pengirim K
            ON b.ID_PENGIRIM = K.ID_PENGIRIM WHERE B.is_delete = 0');
            return view('admin.index')
            
            ->with('datas', $datas);
            }
            }

            public function edit($id) {
                $data = DB::table('paket')->where('ID_BARANG',
                $id)->first();
                return view('admin.edit')->with('data', $data);
                }
                public function update($id, Request $request) {
                $request->validate([
                'ID_PENGIRIM' => 'required',
                'ID_BARANG' => 'required',
                'ID_PENERIMA' => 'required',
                'NAMA_BARANG' => 'required',
                'JENIS' => 'required',
                'BERAT' => 'required',
                'TUJUAN' => 'required',
                ]);
                // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                DB::update('UPDATE paket SET ID_BARANG =
                :ID_BARANG, ID_PENGIRIM = :ID_PENGIRIM, NAMA_BARANG = :NAMA_BARANG, JENIS = :JENIS,
                BERAT = :BERAT, TUJUAN=:TUJUAN WHERE ID_BARANG=:id',
                [
                'id' => $id,
                'ID_PENGIRIM' => $request->ID_PENGIRIM,
                'ID_BARANG' => $request->ID_BARANG,
                'ID_PENERIMA' => $request->ID_PENERIMA,
                'NAMA_BARANG' => $request->NAMA_BARANG,
                'JENIS' => $request->JENIS,
                'BERAT' => $request->BERAT,
                'TUJUAN' => $request->TUJUAN,
                ]
                );
                return redirect()->route('admin.index')->with('success', 'Data barang berhasil diubah');
                }

                public function delete($id) {
                    // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                    DB::delete('DELETE FROM paket WHERE ID_BARANG =
                    :ID_BARANG', ['ID_BARANG' => $id]);
                    return redirect()->route('admin.index')->with('success', 'Data Barang berhasil dihapus');
                    }

                    public function pengirim() {
                        $datas = DB::select('SELECT * FROM pengirim');
                        return view('admin.pengirim')
                        
                        ->with('datas', $datas);
                        }

                    public function search(Request $request){
                        // Get the search value from the request
                        $search = $request->input('search');
                    
                        // Search in the title and body columns from the posts table
                        $posts =DB::table('paket')
                            ->where('Nama_Barang', 'LIKE', "%{$search}%")
                            ->orWhere('Jenis', 'LIKE', "%{$search}%")
                            ->get();
                    
                        // Return the search view with the resluts compacted
                        return view('admin.index',['paket' => $posts]);
                    }
                    public function soft($id)
                    {
                        DB::update('UPDATE paket SET B.is_delete = 1 WHERE id_barang = :id_barang', ['id_barang' => $id]);

                        return redirect()->route('admin.index')->with('success', 'Data Barang berhasil dihapus');
                    }
}
