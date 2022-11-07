<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\career;

class CareerController extends Controller
{

	public function data($datas, $request){
		return career::where($datas,$request)->get();
	}

	public function cari(Request $request){

		$data = career::select('*');
		function arr($query, $bidang, $posisi, $penempatan, $perusahaan){
			return redirect()->back()
			->with('data', $query->paginate(2))
			->with('result', $query->count())
			->with('bidang', $bidang)
			->with('posisi', $posisi)
			->with('penempatan', $penempatan)
			->with('perusahaan', $perusahaan);
		}

		if ($request->bidang_pekerjaan) {
			$data = $data->where('bidang_pekerjaan', $request->bidang_pekerjaan);
			if ($request->posisi) {
				$data = $data->where('posisi',$request->posisi);

				if($request->penempatan){
					$data = $data->where('penempatan', $request->penempatan);

					if($request->perusahaan){
						$data = $data->where('perusahaan', $request->perusahaan);
						return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
					}

					return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
				}

				if($request->perusahaan){
					$data = $data->where('perusahaan', $request->perusahaan);
					return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
				}

				return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
			}

			if($request->penempatan){
				$data = $data->where('penempatan', $request->penempatan);

				if($request->perusahaan){
					$data = $data->where('perusahaan', $request->perusahaan);
					return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
				}

				return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
			}

			return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
		}


		if ($request->posisi) {
			$data = $data->where('posisi', $request->posisi);

			if ($request->penempatan) {
				$data = $data->where('penempatan',$request->penempatan);

				if ($request->perusahaan) {
					$data = $data->where('penempatan',$request->penempatan);
					return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
				}

				return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
			}

			return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
		}


		if ($request->penempatan) {
			$data = $data->where('penempatan', $request->penempatan);

			if ($request->perusahaan) {
				$data = $data->where('perusahaan',$request->perusahaan);
				return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
			}

			return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
		}


		if ($request->perusahaan) {
			$data = $data->where('perusahaan', $request->perusahaan);
			return arr($data, $request->bidang_pekerjaan, $request->posisi, $request->penempatan, $request->perusahaan);
		}

		if ($request->sortby == 'newest') {
			$loker = $data->orderBy('created_at', 'desc');

			if($request->bidang){
				$data = $data->where('bidang_pekerjaan', $request->bidang)->orderBy('created_at', 'desc');

				if($request->lokasi){
					$data = $data->where('posisi', $request->lokasi)->orderBy('created_at', 'desc');

					if($request->tempat){
						$data = $data->where('penempatan', $request->tempat)->orderBy('created_at', 'desc');

						if($request->pt){
							$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
							return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
						}

						return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
					}

					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				if($request->tempat){
					$data = $data->where('penempatan', $request->tempat)->orderBy('created_at', 'desc');

					if($request->pt){
						$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
						return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
					}

					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				if($request->pt){
					$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
			}

			if($request->lokasi){
				$data = $data->where('posisi', $request->lokasi)->orderBy('created_at', 'desc');

				if($request->tempat){
					$data = $data->where('penempatan', $request->tempat)->orderBy('created_at', 'desc');

					if($request->pt){
						$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
						return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
					}

					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
			}

			if($request->tempat){
				$data = $data->where('penempatan', $request->tempat)->orderBy('created_at', 'desc');

					if($request->pt){
						$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
						return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
					}

				return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
			}

			if($request->pt){
				$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
				return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
			}

			return redirect('/career')
			->with('data',$loker->get())
			->with('result',$loker->count());
		}

		for ($i = 0; $i < 5; $i++){
			if ($request->page == $i){

				if($request->bidang){
				$data = $data->where('bidang_pekerjaan', $request->bidang)->orderBy('created_at', 'asc');

				if($request->lokasi){
					$data = $data->where('posisi', $request->lokasi)->orderBy('created_at', 'desc');

					if($request->tempat){
						$data = $data->where('penempatan', $request->tempat)->orderBy('created_at', 'desc');

						if($request->pt){
							$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
							return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
						}

						return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
					}

					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				if($request->tempat){
					$data = $data->where('penempatan', $request->tempat)->orderBy('created_at', 'desc');

					if($request->pt){
						$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
						return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
					}

					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				if($request->pt){
					$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				if($request->lokasi){
					$data = $data->where('posisi', $request->lokasi)->orderBy('created_at', 'desc');

					if($request->tempat){
						$data = $data->where('penempatan', $request->tempat)->orderBy('created_at', 'desc');

						if($request->pt){
							$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
							return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
						}

						return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
					}

					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				if($request->tempat){
					$data = $data->where('penempatan', $request->tempat)->orderBy('created_at', 'desc');

						if($request->pt){
							$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
							return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
						}

					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}

				if($request->pt){
					$data = $data->where('perusahaan', $request->pt)->orderBy('created_at', 'desc');
					return arr($data, $request->bidang, $request->lokasi, $request->tempat, $request->pt);
				}
			}
		}

		$loker = $data->orderBy('created_at', 'asc');
		// return $request->paginate(2);
			return redirect('/career')
			->with('data',$loker->Paginate(2))
			->with('result',$loker->count());;
	}

    public function caris(Request $request){
    	$select = career::select('*');

    	if ($request->bidang_pekerjaan){
    		$data = $select->where('bidang_pekerjaan',$request->bidang_pekerjaan);


    		if($request->posisi){
    			$data2 = $data->where('posisi',$request->posisi);

	    		if($request->penempatan){
	    			$data3 = $data2->where('penempatan', $request->penempatan);

	    			if($request->perusahaan){
	    				$data4 = $data3->where('perusahaan', $request->perusahaan);

	    				return redirect()->back()
		    			->with('data', $data4->get())
		    			->with('result', $data4->count())
		    			->with('perusahaan', $data4->first()->perusahaan)
		    			->with('penempatan', $data4->first()->penempatan)
		    			->with('posisi', $data4->first()->posisi)
		    			->with('bidang', $data4->first()->bidang_pekerjaan);
	    			}

	    			return redirect()->back()
		    		->with('data', $data3->get())
		    		->with('result', $data3->count())
		    		->with('penempatan', $data3->first()->penempatan)
		    		->with('posisi', $data3->first()->posisi)
	    			->with('bidang', $data3->first()->bidang_pekerjaan);

				}
    			return redirect()->back()
	    		->with('data', $data2->get())
	    		->with('result', $data2->count())
	    		->with('posisi', $data2->first()->posisi)
	    		->with('bidang', $data2->first()->bidang_pekerjaan);


	    	}

	    	if($request->penempatan){
	    		$data2 = $data->where('penempatan',$request->penempatan)->get();

	    		if (!$query->first()) {
	    				return redirect()->back()
	    				->with('data', $data2->get())
	    				->with('result', $data2->count())
	    				->with('perusahaan', $request->perusahaan)
	    				->with('penempatan', $request->penempatan)
	    				->with('posisi', $request->posisi)
	    				->with('bidang', $request->bidang_pekerjaan); 
	    		}

	    		if($request->perusahaan){
	    			$data3 = $data2->where('perusahaan', $request->perusahaan);

	    			if (!$data3->first()) {
	    				return redirect()->back()
	    				->with('data', $data3->get())
	    				->with('result', $data3->count())
	    				->with('perusahaan', $request->perusahaan)
	    				->with('penempatan', $request->penempatan)
	    				->with('posisi', $request->posisi)
	    				->with('bidang', $request->bidang_pekerjaan); 
	    			}

	    			return redirect()->back()
		    		->with('data', $data3->get())
		    		->with('result', $data3->count())
		    		->with('perusahaan', $data3->first()->perusahaan)
		    		->with('posisi', $data3->first()->posisi)
	    			->with('bidang', $data3->first()->bidang_pekerjaan);
	    		}

    			return redirect()->back()
	    		->with('data', $data2)
	    		->with('result', $data2->count())
	    		->with('penempatan', $data2->first()->penempatan)
		    	->with('bidang', $data2->first()->bidang_pekerjaan);
	    	}

	    	if($request->perusahaan){
	    		$data2 = $data->where('perusahaan', $request->perusahaan);

	    		if (!$data2->first()) {
		    		return redirect()->back()
		    		->with('data', $data2->get())
	    			->with('result', $data2->count())
	    			->with('perusahaan', $request->perusahaan)
	    			->with('penempatan', $request->penempatan)
	    			->with('posisi', $request->posisi)
	    			->with('bidang', $request->bidang_pekerjaan); 
	    		}

	    		return redirect()->back()
					->with('data', $data2->get())
		    		->with('result', $data2->count())
		    		->with('perusahaan', $data2->first()->perusahaan)
		    		->with('penempatan', $data2->first()->penempatan)
		    		->with('posisi', $data2->first()->posisi)
		    		->with('bidang', $data2->first()->bidang_pekerjaan);

	    	}
    		return redirect()->back()
    		->with('data', $data->get())
    		->with('result',$data->count())
    		->with('bidang', $data->first()->bidang_pekerjaan);
    	}
    	if ($request->posisi){
    		$data = $select->where('posisi',$request->posisi);

    		if (!$data->first()) {
	    				return redirect()->back()
	    				->with('data', $data2->get())
	    				->with('result', $data2->count()); 
	    			}

    		if($request->penempatan){
	    		$data2 = $data->where('penempatan', $request->penempatan);

	    		if (!$data->first()) {
	    				return redirect()->back()
	    				->with('data', $data2->get())
	    				->with('result', $data2->count()); 
	    			}

	    		if($request->perusahaan){
	    			$data3 = $data2->where('perusahaan', $request->perusahaan);
	    			return redirect()->back()
		    		->with('data', $data3->get())
		    		->with('result', $data3->count());
	    		}
	    		return redirect()->back()
		    	->with('data', $data2->get())
		    	->with('result', $data2->count());
			}

    		return redirect()->back()
    		->with('data', $data->get())
    		->with('result',$data->count())
    		->with('posisi',$request->posisi);
    	}
    	if ($request->penempatan){
    		$data = $select->where('penempatan',$request->penempatan);

    		if($request->perusahaan){
	    		$data2 = $data->where('perusahaan', $request->perusahaan);
	    		return redirect()->back()
		    	->with('data', $data2->get())
		    	->with('result', $data2->count());
	    	}

    		return redirect()->back()
    		->with('data', $data->get())
    		->with('result', $data->count());
    	}
    	if ($request->perusahaan){
    		$data = $select->where('perusahaan',$request->perusahaan);
    		return redirect()->back()
    		->with('data', $data->get())
    		->with('result',$data->count());
    	}

    	// return redirect('/career')->with('error','data kosong');
    	return redirect()->back()->with('error', $select->count()); 
    }
}
