<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Exports\BukuExport;
use Maatwebsite\Excel\Facades\Excel;
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::paginate(3);
        return view('data_buku.index', compact('buku'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_buku.form_create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|max:4'
            ],
            [
                'judul.required' => 'judul wajib diisi',
                'penulis.required' => 'penulis wajib diisi',
                'penerbit.required' => 'penerbit wajib diisi',
                'tahun_terbit.required' => 'tahun terbit wajib diisi',
            ],
        );

        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
        ];

        Buku::create($data);
        return redirect()->route('buku.index')->with('success'. 'Data Berhasil di Simpan!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dt = Buku::find($id);
        return view('data_buku.form_edit',compact('dt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::findorfail($id);
        $buku->update($request->all());
        return redirect()->route('buku.index')->with('success'. 'Data Berhasil di Edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::find($id)->delete();

        return back()->with('success', 'Data berhasil dihapus');
    } 
    public function export_pdf(Request $request)
    {
        //DECLARE REQUEST
        //QUERY
        $buku = Buku::select('*');
        
        $buku = $buku->get();

        // Meneruskan parameter ke tampilan ekspor
        $pdf = PDF::loadview('data_buku.exportPdf', ['data'=>$buku]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // SET FILE NAME
        $filename = date('YmdHis') . 'data_buku';
        // untuk mendownload file pdf
        return $pdf->download($filename.'.pdf');
    }
    public function export_excel()
    {
    return Excel::download(new BukuExport, 'buku.xlsx');
    }
  
    }
