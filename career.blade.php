@extends('front.layouts.app')
@section('content')
           <!--  <div class="menu-left">
                <div class="container">
                    <nav style="float:none; display:table; margin:10px auto;">
                        <ul>
                            <li>
                                <a href="/">Bidang Pekerjaan</a>
                            </li>
                            <li>
                                <a href="/">Anda Selanjutnya</a>
                            </li>
                            <li>
                                <a href="/">Temukan Pekerjaan</a>
                            </li>
                            <li>
                                <a href="/">Bantuan Karir</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> -->
            
            <section class="py-4 pt-0 activation-section">
                <div class="bg-shape" style="background-image: url({{ asset('images/bg-img-shape.svg') }});padding: 5rem 0 !important;">
                    <div class="container">
                        <div class="heading-text text-center">
                            <h2 class="text-uppercase">
                                <span>Karir</span>
                            </h2>
                            @foreach ($data as $datas)
                            <!-- {{$datas}} -->
                            @endforeach
                            {{Session::get('bidang')}}</br>
                            {{Session::get('posisi')}}</br>
                            {{Session::get('penempatan')}}</br>
                            {{Session::get('perusahaan')}}</br>
                            <!-- {{Session::get('data')}}</br> -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- <section class="py-4 pt-0 activation-section">
               <div id="" class="menu-left">
                <div class="col-md-8 container">
                <div class="">
                 <nav class="navbar navbar-expand-lg justify-content-center nav-black nav-font">
                  <a class="nav-link" href="#">Filter</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse filter" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex mr-auto" style="gap:2rem; margin-bottom: 0">
                      <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option selected>Bidang Pekerjaan</option>
                          <option>2</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option selected>Posisi</option>
                          <option>2</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option selected>Penempatan</option>
                          <option>2</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option selected>Perusahaan</option>
                          <option>2</option>
                        </select>
                      </div>
                    </ul>
                    
                  </div>
                </nav>
                </div>
                </div>
            </div>
            </section> -->
        <section>
            <div class="col-md-8 m-auto container filters">
                <form method="get" action="{{ url('cari') }}">
                    <div class="d-flex nav-black nav-font justify-content-around align-items-center search">
                        <div class="filter">
                            <span>Filter</span>
                        </div>
                        <div class="d-flex navbar-custom collapsed nav-font">
                            <select name="bidang_pekerjaan" class="custom-select" id="inlineFormCustomSelectPref">
                                <option value='' selected>Bidang Pekerjaan</option>
                                @foreach ($bidang as $bidang)

                                <option value="{{$bidang->bidang_pekerjaan}}" @if ($bidang->bidang_pekerjaan == Session::get('bidang')) selected @endif >{{$bidang->bidang_pekerjaan}}</option>

                                @endforeach
                            </select>
                            
                            <select name="posisi" class="custom-select" id="inlineFormCustomSelectPref">
                                <option value='' selected>Posisi</option>
                                @foreach ($posisi as $posisi)

                                <option value="{{$posisi->posisi}}" @if ($posisi->posisi == Session::get('posisi')) selected @endif >{{$posisi->posisi}}</option>
                                
                                @endforeach
                            </select>
                            <select name="penempatan" class="custom-select" id="inlineFormCustomSelectPref">
                                <option value='' selected>Penempatan</option>
                                @foreach ($penempatan as $penempatan)

                                <option value="{{$penempatan->penempatan}}" 
                                  @foreach ($penempatan as $tempat) 

                                  @if ($penempatan->penempatan == Session::get('penempatan')) selected @endif

                                  @endforeach >{{$penempatan->penempatan}}</option>

                                @endforeach
                            </select>
                            <select name="perusahaan" class="custom-select" id="inlineFormCustomSelectPref">
                                <option value='' selected>Perusahaan</option>
                                @foreach ($perusahaan as $perusahaan)

                                <option value="{{$perusahaan->perusahaan}}" @if ($perusahaan->perusahaan == Session::get('perusahaan')) selected @endif >{{$perusahaan->perusahaan}}</option>

                                @endforeach
                            </select>
                        </div>
                        </form>
                        <div class="collapsed">
                            <button type="submit"><i style="color: white;" class="bi bi-search"></i></button>
                        </div>
                        <div class="filter-search show">
                        <a class="btn-search-close" onclick="openNav()">
                                <i style="color: white;" class="bi bi-sliders"></i>
                        </a>
                        </div>
                    </div>
                </div>

            <div class="container col-md-8 ">
            <div class="row justify-content-between">
                  @if (\Session::has('error'))
                    <!-- <p>{!! \Session::get('error') !!}</p> -->
                  @endif

                  @if(!\Session::has('data'))
                  <div class="col-md-6 left-content">
                      <p>{{$count}} Lowongan Pekerjaan Ditemukan</p>
                      @foreach ($loker as $datas)
                      <div class="d-flex pb-4">
                         <div id="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo">
                            </a>
                         </div>
                         <div class="contents">
                             <h4>{{$datas->posisi}}</h4>
                             <p>Garam Cap Kapal</p>
                             <div class="d-flex pb-4"style="gap:2rem; margin-left: 1.5rem">
                                <div class="var">
                                    <li>Penempatan</li>
                                    <li>Bidang Pekerjaan</li>
                                    <li>Kebutuhan</li>
                                 </div>
                                 <div class="val">
                                    <li>{{$datas->penempatan}}</li>
                                    <li>{{$datas->bidang_pekerjaan}}</li>
                                    <li>{{$datas->kebutuhan}} Orang</li>
                                 </div>
                             </div>
                             <div class="contents"> 
                            <h4>Kualifikasi</h4>
                            <li style="list-style: none;">{{$datas->kualifikasi}}</li>
                            <br>
                            <p>Tanggal lowongan: {{ date('d/m/Y', strtotime($datas->created_at)) }}</p>
                            </div>
                         </div>
                    </div>
                @endforeach
                </div>
                 <div class="col-md-6 right-content">
                    {{session::get('bidang')}}
                    <p><a href="{{url('cari?sortby=newest')}}">Urutkan Berdasarkan Lowongan Terbaru</a></p>
                    <!-- <button class="nav-font button"><h4>Selanjutnyad</h4></button>
                    {{$loker->url($loker->currentPage()+1)}}
                    {{ $loker->links() }}
                    {{ $loker->lastPage() }}
                    <p>{{ $loker->currentPage() }}</p> -->


                    @if ($loker->lastPage() > 1)
                    <ul class="pagination">
                      <li class="{{ ($loker->currentPage() == 1) ? 'disabled' : ''}}">
                        <a href="{{ $loker->url($loker->currentPage()-1) }}"><h4>Kembali</h4></a>
                      </li>
                      <!-- @for ($i = 0; $i <= $loker->lastPage(); $i++)
                        <li class="{{ ($loker->currentPage() == $i) ? 'active' : '' }}">
                          <a href="{{ $loker->url($i) }}">{{ $i }}</a>
                        </li>
                      @endfor -->
                      <li class="{{ ($loker->currentPage() == $loker->lastPage()) ? 'disabled' : ''}}">
                        <a class="" href="{{ $loker->url($loker->currentPage()+1) }}"><h4>Selanjutnya</h4></a>
                      </li>
                    </ul>

                    @endif
                    <!-- <p>Tanggal Posting</p>
                    <p>3/10/2022</p> -->
                </div>
                  @else
                   <div class="col-md-6 left-content">
                      <p>{!! \Session::get('result') !!} Lowongan Pekerjaan Ditemukan</p>
                      
                      @foreach (\Session::get('data') as $datas)
                      <div class="d-flex pb-4">
                         <div id="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo">
                            </a>
                         </div>
                         <div class="contents">
                             <h4>{{$datas->posisi}}</h4>
                             <p>Garam Cap Kapal</p>
                             <div class="d-flex pb-4"style="gap:2rem; margin-left: 1.5rem">
                                <div class="var">
                                    <li>Penempatan</li>
                                    <li>Bidang Pekerjaan</li>
                                    <li>Kebutuhan</li>
                                 </div>
                                 <div class="val">
                                    <li>{{$datas->penempatan}}</li>
                                    <li>{{$datas->bidang_pekerjaan}}</li>
                                    <li>{{$datas->kebutuhan}} Orang</li>
                                 </div>
                             </div>
                             <div class="contents"> 
                            <h4>Kualifikasi</h4>
                            <li style="list-style: none;">{{$datas->kualifikasi}}</li>
                            <br>
                            <p>Tanggal lowongan: {{ date('d/m/Y', strtotime($datas->created_at)) }}</p>
                            </div>
                         </div>
                    </div>
                @endforeach
                </div>
                 <div class="col-md-6 right-content">
                    @php
                    $bidang = session::get('bidang');
                    $posisi = session::get('posisi');
                    $penempatan = session::get('penempatan');
                    $perusahaan = session::get('perusahaan');
                    $data = Session::get('data');
                    $next = $data->currentPage()+1;
                    $previous = $data->currentPage()-1;
                    @endphp
                    <p><a href="{{ url('cari?sortby=newest&bidang='.$bidang.'&lokasi='.$posisi.'&tempat='.$penempatan.'&pt='.$perusahaan.'') }}">Urutkan Berdasarkan Lowongan Terbaru</a></p>
                    <!-- <button class="nav-font button"><h4>Selanjutnya</h4></button>
                    {{Session::get('data')}}

                    <p>Tanggal Posting</p>
                    <p>3/10/2022</p> -->

                    @if ($data->lastPage() > 1)
                    <ul class="pagination">
                      <li class="{{ ($data->currentPage() == 1) ? 'disabled' : ''}}">
                        <a href="{{ url('cari?page='.$previous.'&bidang='.$bidang.'&lokasi='.$posisi.'&tempat='.$penempatan.'&pt='.$perusahaan.'') }}"><h4>Kembali</h4></a>
                      </li>
                      <!-- @for ($i = 0; $i <= $loker->lastPage(); $i++)
                        <li class="{{ ($loker->currentPage() == $i) ? 'active' : '' }}">
                          <a href="{{ $loker->url($i) }}">{{ $i }}</a>
                        </li>
                      @endfor -->
                      <li class="{{ ($data->currentPage() == $data->lastPage()) ? 'disabled' : ''}}">
                        <a class="" href="{{ url('cari?page='.$next.'&bidang='.$bidang.'&lokasi='.$posisi.'&tempat='.$penempatan.'&pt='.$perusahaan.'') }}"><h4>Selanjutnya</h4></a>
                      </li>
                    </ul>

                    @endif

                </div>
                @endif
            </div>
            </div>
        </section>
        <div id="mySidenavs" class="sidenav nav-font">
        <div class="sidenav-container">
            <div class="sidenav-header">
             <a href="javascript:void(0)" class="closebtnd" onclick="closeNav()">&times;</a>
             <span>Filter Pencarian</span>
        </div>

        <div class="sidenav-main">
            <form>
               <select class="form-select" aria-label="Default select example">
                  <option selected>Bidang Pekerjaan</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>

               <select class="form-select" aria-label="Default select example">
                  <option selected>Posisi</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>

                <select class="form-select" aria-label="Default select example">
                  <option selected>Penempatan</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>

                 <select class="form-select" aria-label="Default select example">
                  <option selected>Perusahaan</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
        </div>

        <div class="sidenav-footer">
             <button type="submit" class="btn">Submit</button>
            </form>    
        </div>
    </div>
</div>

    <script>
        function openNav() {
          document.getElementById("mySidenavs").style.height = "100%";
        }

        function closeNav() {
          document.getElementById("mySidenavs").style.height = "0";
        }
    </script>
@endsection
 <!--  <form>
                <select class="form-control">
                    <option>Default select</option>
                    <option>Default select</option>
                </select>
                <select class="form-control">
                    <option>Default select</option>
                    <option>Default select</option>
                </select>
                <select class="form-control">
                    <option>Default select</option>
                    <option>Default select</option>
                </select>
                <select class="form-control">
                    <option>Default select</option>
                    <option>Default select</option>
                </select>
                <select class="form-control">
                    <option>Default select</option>
                    <option>Default select</option>
                </select>
              </div>
            </form> -->