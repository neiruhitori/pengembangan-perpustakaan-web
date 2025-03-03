<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

use App\Models\PeminjamanTahunan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    // Untuk isi Kelas VII A ==============================================================================
    public function kelas_viia(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        // $viia = PeminjamanTahunan::where('kelas', 'VII A')->orderBy('name', 'ASC')->paginate(35);

        $viia = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII A');
        })->paginate(35);

        return view('kelas.vii.a', compact('viia', 'profile'));
    }

    public function search_viia(Request $request)
    {
        // $search = $request->search;
        // $viia = PeminjamanTahunan::where(function($query) use ($search){
        //     $query->where('name','like',"%$search%")->where('kelas', 'VII A');
        // })
        // ->orWhereHas('bukus', function($query) use($search){
        //     $query->where('kodebuku', 'like', "%$search%")->where('kelas', 'VII A');
        // })
        // ->get();

        $keyword = $request->search;
            $viia = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII A');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII A');
            })->get();

        return view('kelas.vii.a', compact('viia'));
    }

    public function pdf_viia()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        // $viia = PeminjamanTahunan::where('kelas', 'VII A')->get();
        $viia = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII A');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.vii.pdf_a', ['viia' => $viia]);
        return $pdf->stream('data-perpustakaan-VII-A.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VII B ==============================================================================
    public function kelas_viib(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viib = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII B');
        })->paginate(35);

        return view('kelas.vii.b', compact('viib', 'profile'));
    }

    public function search_viib(Request $request)
    {
        $keyword = $request->search;
            $viib = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII B');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII B');
            })->get();
        return view('kelas.vii.b', compact('viib'));
    }

    public function pdf_viib()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viib = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII B');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.vii.pdf_b', ['viib' => $viib]);
        return $pdf->stream('data-perpustakaan-VII-B.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VII C ==============================================================================
    public function kelas_viic(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viic = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII C');
        })->paginate(35);

        return view('kelas.vii.c', compact('viic', 'profile'));
    }

    public function search_viic(Request $request)
    {
        $keyword = $request->search;
            $viic = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII C');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII C');
            })->get();
        return view('kelas.vii.c', compact('viic'));
    }

    public function pdf_viic()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viic = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII C');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.vii.pdf_c', ['viic' => $viic]);
        return $pdf->stream('data-perpustakaan-VII-C.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VII D ==============================================================================
    public function kelas_viid(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viid = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII D');
        })->paginate(35);

        return view('kelas.vii.d', compact('viid', 'profile'));
    }

    public function search_viid(Request $request)
    {
        $keyword = $request->search;
            $viid = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII D');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII D');
            })->get();
        return view('kelas.vii.d', compact('viid'));
    }

    public function pdf_viid()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viid = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII D');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.vii.pdf_d', ['viid' => $viid]);
        return $pdf->stream('data-perpustakaan-VII-D.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VII E ==============================================================================
    public function kelas_viie(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viie = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII E');
        })->paginate(35);

        return view('kelas.vii.e', compact('viie', 'profile'));
    }

    public function search_viie(Request $request)
    {
        $keyword = $request->search;
            $viie = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII E');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII E');
            })->get();
        return view('kelas.vii.e', compact('viie'));
    }

    public function pdf_viie()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viie = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII E');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.vii.pdf_e', ['viie' => $viie]);
        return $pdf->stream('data-perpustakaan-VII-E.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VII F ==============================================================================
    public function kelas_viif(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viif = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII F');
        })->paginate(35);

        return view('kelas.vii.f', compact('viif', 'profile'));
    }

    public function search_viif(Request $request)
    {
        $keyword = $request->search;
            $viif = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII F');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII F');
            })->get();
        return view('kelas.vii.f', compact('viif'));
    }

    public function pdf_viif()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viif = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII F');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.vii.pdf_f', ['viif' => $viif]);
        return $pdf->stream('data-perpustakaan-VII-F.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VII G ==============================================================================
    public function kelas_viig(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viig = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII G');
        })->paginate(35);

        return view('kelas.vii.g', compact('viig', 'profile'));
    }

    public function search_viig(Request $request)
    {
        $keyword = $request->search;
            $viig = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII G');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VII G');
            })->get();
        return view('kelas.vii.g', compact('viig'));
    }

    public function pdf_viig()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viig = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VII G');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.vii.pdf_g', ['viig' => $viig]);
        return $pdf->stream('data-perpustakaan-VII-G.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VIII A ==============================================================================
    public function kelas_viiia(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viiia = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII A');
        })->paginate(35);

        return view('kelas.viii.a', compact('viiia', 'profile'));
    }

    public function search_viiia(Request $request)
    {
        $keyword = $request->search;
            $viiia = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII A');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII A');
            })->get();
        return view('kelas.viii.a', compact('viiia'));
    }

    public function pdf_viiia()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viiia = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII A');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.viii.pdf_a', ['viiia' => $viiia]);
        return $pdf->stream('data-perpustakaan-VIII-A.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VIII B ==============================================================================
    public function kelas_viiib(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viiib = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII B');
        })->paginate(35);

        return view('kelas.viii.b', compact('viiib', 'profile'));
    }

    public function search_viiib(Request $request)
    {
        $keyword = $request->search;
            $viiib = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII B');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII B');
            })->get();
        return view('kelas.viii.b', compact('viiib'));
    }

    public function pdf_viiib()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viiib = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII B');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.viii.pdf_b', ['viiib' => $viiib]);
        return $pdf->stream('data-perpustakaan-VIII-B.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VIII C ==============================================================================
    public function kelas_viiic(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viiic = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII C');
        })->paginate(35);

        return view('kelas.viii.c', compact('viiic', 'profile'));
    }

    public function search_viiic(Request $request)
    {
        $keyword = $request->search;
            $viiic = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII C');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII C');
            })->get();
        return view('kelas.viii.c', compact('viiic'));
    }

    public function pdf_viiic()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viiic = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII C');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.viii.pdf_c', ['viiic' => $viiic]);
        return $pdf->stream('data-perpustakaan-VIII-C.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VIII D ==============================================================================
    public function kelas_viiid(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viiid = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII D');
        })->paginate(35);

        return view('kelas.viii.d', compact('viiid', 'profile'));
    }

    public function search_viiid(Request $request)
    {
        $keyword = $request->search;
            $viiid = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII D');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII D');
            })->get();
        return view('kelas.viii.d', compact('viiid'));
    }

    public function pdf_viiid()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viiid = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII D');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.viii.pdf_d', ['viiid' => $viiid]);
        return $pdf->stream('data-perpustakaan-VIII-D.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VIII E ==============================================================================
    public function kelas_viiie(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viiie = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII E');
        })->paginate(35);

        return view('kelas.viii.e', compact('viiie', 'profile'));
    }

    public function search_viiie(Request $request)
    {
        $keyword = $request->search;
            $viiie = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII E');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII E');
            })->get();
        return view('kelas.viii.e', compact('viiie'));
    }

    public function pdf_viiie()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viiie = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII E');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.viii.pdf_e', ['viiie' => $viiie]);
        return $pdf->stream('data-perpustakaan-VIII-E.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VIII F ==============================================================================
    public function kelas_viiif(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viiif = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII F');
        })->paginate(35);

        return view('kelas.viii.f', compact('viiif', 'profile'));
    }

    public function search_viiif(Request $request)
    {
        $keyword = $request->search;
            $viiif = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII F');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII F');
            })->get();
        return view('kelas.viii.f', compact('viiif'));
    }

    public function pdf_viiif()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viiif = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII F');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.viii.pdf_f', ['viiif' => $viiif]);
        return $pdf->stream('data-perpustakaan-VIII-F.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas VIII G ==============================================================================
    public function kelas_viiig(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $viiig = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII G');
        })->paginate(35);

        return view('kelas.viii.g', compact('viiig', 'profile'));
    }

    public function search_viiig(Request $request)
    {
        $keyword = $request->search;
            $viiig = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII G');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'VIII G');
            })->get();
        return view('kelas.viii.g', compact('viiig'));
    }

    public function pdf_viiig()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $viiig = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'VIII G');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.viii.pdf_g', ['viiig' => $viiig]);
        return $pdf->stream('data-perpustakaan-VIII-G.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas IX A ==============================================================================
    public function kelas_ixa(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $ixa = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX A');
        })->paginate(35);

        return view('kelas.ix.a', compact('ixa', 'profile'));
    }

    public function search_ixa(Request $request)
    {
        $keyword = $request->search;
            $ixa = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX A');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX A');
            })->get();
        return view('kelas.ix.a', compact('ixa'));
    }

    public function pdf_ixa()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $ixa = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX A');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.ix.pdf_a', ['ixa' => $ixa]);
        return $pdf->stream('data-perpustakaan-IX-A.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas IX B ==============================================================================
    public function kelas_ixb(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $ixb = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX B');
        })->paginate(35);

        return view('kelas.ix.b', compact('ixb', 'profile'));
    }

    public function search_ixb(Request $request)
    {
        $keyword = $request->search;
            $ixb = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX B');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX B');
            })->get();
        return view('kelas.ix.b', compact('ixb'));
    }

    public function pdf_ixb()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $ixb = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX B');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.ix.pdf_b', ['ixb' => $ixb]);
        return $pdf->stream('data-perpustakaan-IX-B.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas IX C ==============================================================================
    public function kelas_ixc(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $ixc = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX C');
        })->paginate(35);

        return view('kelas.ix.c', compact('ixc', 'profile'));
    }

    public function search_ixc(Request $request)
    {
        $keyword = $request->search;
            $ixc = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX C');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX C');
            })->get();
        return view('kelas.ix.c', compact('ixc'));
    }

    public function pdf_ixc()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $ixc = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX C');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.ix.pdf_c', ['ixc' => $ixc]);
        return $pdf->stream('data-perpustakaan-IX-C.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas IX D ==============================================================================
    public function kelas_ixd(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $ixd = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX D');
        })->paginate(35);

        return view('kelas.ix.d', compact('ixd', 'profile'));
    }

    public function search_ixd(Request $request)
    {
        $keyword = $request->search;
            $ixd = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX D');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX D');
            })->get();
        return view('kelas.ix.d', compact('ixd'));
    }

    public function pdf_ixd()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $ixd = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX D');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.ix.pdf_d', ['ixd' => $ixd]);
        return $pdf->stream('data-perpustakaan-IX-D.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas IX E ==============================================================================
    public function kelas_ixe(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $ixe = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX E');
        })->paginate(35);

        return view('kelas.ix.e', compact('ixe', 'profile'));
    }

    public function search_ixe(Request $request)
    {
        $keyword = $request->search;
            $ixe = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX E');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX E');
            })->get();
        return view('kelas.ix.e', compact('ixe'));
    }

    public function pdf_ixe()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $ixe = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX E');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.ix.pdf_e', ['ixe' => $ixe]);
        return $pdf->stream('data-perpustakaan-IX-E.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas IX F ==============================================================================
    public function kelas_ixf(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $ixf = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX F');
        })->paginate(35);

        return view('kelas.ix.f', compact('ixf', 'profile'));
    }

    public function search_ixf(Request $request)
    {
        $keyword = $request->search;
            $ixf = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX F');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX F');
            })->get();
        return view('kelas.ix.f', compact('ixf'));
    }

    public function pdf_ixf()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $ixf = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX F');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.ix.pdf_f', ['ixf' => $ixf]);
        return $pdf->stream('data-perpustakaan-IX-F.pdf', compact('profile'));
    }
    // ====================================================================================================
    // Untuk isi Kelas IX G ==============================================================================
    public function kelas_ixg(Request $request)
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();   

        $ixg = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX G');
        })->paginate(35);

        return view('kelas.ix.g', compact('ixg', 'profile'));
    }

    public function search_ixg(Request $request)
    {
        $keyword = $request->search;
            $ixg = PeminjamanTahunan::whereHas('siswas', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX G');
            })->orWhereHas('bukus', function ($query) use ($keyword) {
                $query->where('kodebuku', 'like', '%' . $keyword . '%');
            })->whereHas('siswas', function ($query) {
                $query->where('kelas', 'IX G');
            })->get();
        return view('kelas.ix.g', compact('ixg'));
    }

    public function pdf_ixg()
    {
        $iduser = Auth::id();
        $profile = User::where('id',$iduser)->first();
        
        $ixg = PeminjamanTahunan::whereHas('siswas', function ($query) {
            $query->where('kelas', 'IX G');
        })->paginate(35);
        $pdf = Pdf::loadView('kelas.ix.pdf_g', ['ixg' => $ixg]);
        return $pdf->stream('data-perpustakaan-IX-G.pdf', compact('profile'));
    }
    // ====================================================================================================
}
