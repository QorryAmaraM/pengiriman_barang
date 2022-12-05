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
        'id_barang' => 'required',
        'id_pengirim' => 'required',
        'nama_barang' => 'required',
        'jenis' => 'required',
        'berat' => 'required',
        'tujuan' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO paket (id_barang,id_pengirim,
        nama_barang, jenis, berat, tujuan) VALUES
        (:id_barang, :id_pengirim, :nama_barang, :jenis, :berat,
        :tujuan)',
        [
        'id_barang' => $request->id_barang,
        'id_pengirim' => $request->id_pengirim,
        'nama_barang' => $request->nama_barang,
        'jenis' => $request->jenis,
        'berat' => $request->berat,
        'tujuan' => $request->tujuan
        ]
        );
        return redirect()->route('admin.index')->with('success', 'Data Barang berhasil disimpan');
        }

        public function index(Request $request) {
            if ($request->has('search')){
                $datas = DB::select('SELECT B.id_barang, K.nama_pengirim, B.nama_barang, B.jenis, B.berat, B.tujuan, T.nama_penerima
            FROM paket B LEFT JOIN pengirim K 
            ON B.id_pengirim = K.id_pengirim LEFT JOIN penerima T ON B.id_penerima = T.id_penerima WHERE B.is_delete = 0 and B.nama_barang like \'%'. $request->search . '%\'');
            return view('admin.index')
            
            ->with('datas', $datas);
            } else {
                $datas = DB::select('SELECT B.id_barang, K.nama_pengirim, B.nama_barang, B.jenis, B.berat, B.tujuan, T.nama_penerima
            FROM paket B LEFT JOIN pengirim K
            ON B.id_pengirim = K.id_pengirim LEFT JOIN penerima T ON B.id_penerima = T.id_penerima WHERE B.is_delete = 0');
            return view('admin.index')
            
            ->with('datas', $datas);
            }
            }

            public function edit($id) {
                $data = DB::table('paket')->where('id_barang',
                $id)->first();
                return view('admin.edit')->with('data', $data);
                }
                public function update($id, Request $request) {
                $request->validate([
                'id_barang' => 'required',
                'id_pengirim' => 'required',
                'nama_barang' => 'required',
                'jenis' => 'required',
                'berat' => 'required',
                'tujuan' => 'required',
                ]);
                // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                DB::update('UPDATE paket SET id_barang =
                :id_barang, id_pengirim = :id_pengirim, nama_barang = :nama_barang, jenis = :jenis,
                berat = :berat, tujuan = :tujuan WHERE id_barang=:id',
                [
                'id' => $id,
                'id_barang' => $request->id_barang,
                'id_pengirim' => $request->id_pengirim,
                'nama_barang' => $request->nama_barang,
                'jenis' => $request->jenis,
                'berat' => $request->berat,
                'tujuan' => $request->tujuan,
                ]
                );
                return redirect()->route('admin.index')->with('success', 'Data barang berhasil diubah');
                }

                public function delete($id) {
                    // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
                    DB::delete('DELETE FROM paket WHERE id_barang =
                    :id_barang', ['id_barang' => $id]);
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
                            ->where('nama_barang', 'LIKE', "%$search%")
                            ->orWhere('jenis', 'LIKE', "%$search%")
                            ->get();
                    
                        // Return the search view with the resluts compacted
                        return view('admin.index',['paket' => $posts]);
                    }
                    public function soft($id)
                    {
                        DB::update('UPDATE paket SET is_delete = 1 WHERE id_barang = :id_barang', ['id_barang' => $id]);

                        return redirect()->route('admin.index')->with('success', 'Data Barang berhasil dihapus');
                    }
}
