@extends('layouts.mainLayout')

@section('body')
    <div>
        <h1 class="mb-4 text-center">Tentang Kami</h1>

        <div class="card shadow p-5" style="margin-bottom: 80px">
            <p class="mb-0" style="font-size: 18px; text-align: justify">Andri Jaya Telor merupakan usaha dagang (UD)
                merupakan
                peternakan telur ayam negeri yang telah berkomitmen untuk memberikan produk berkualitas tinggi kepada
                pelanggan kami sejak awal berdiri. Kami
                menghargai kepercayaan pelanggan kami dan berkomitmen untuk terus meningkatkan proses produksi kami demi
                memberikan produk terbaik. Dengan standar kualitas yang kami miliki, kami memastikan setiap telur yang
                dihasilkan tidak hanya lezat, tetapi juga
                aman untuk dikonsumsi.
            
                Visi: Menjadi peternakan yang memprioritaskan kualitas dan inovasi dalam pembuatan telur berkualitas yang memenuhi standar keamanan pangan dan kesejahteraan hewan.
            </p>
        </div>

        <hr style="margin-bottom: 100px">

        <div class="row" style="margin-bottom: 100px">
            <div class="col-12 col-md-12 col-lg-5 mb-2 pe-5">
                <h1 class="mb-3">Visi</h1>
                <p style="font-size: 18px; text-align: justify">Menjadi peternakan yang memprioritaskan kualitas dan inovasi dalam pembuatan telur berkualitas yang memenuhi standar keamanan pangan dan kesejahteraan hewan.</p>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div style="height: 400px">
                    <img class="h-100 w-100 rounded" style="object-fit: cover; object-position: center"
                        src="{{ asset('img/peternakan.jpeg') }}" alt="Peternakan Andri Jaya Telor">
                </div>
            </div>
        </div>
        
        <div class="row" style="margin-bottom: 100px">
            <div class="col-12 col-md-12 col-lg-6">
                <div style="height: 400px">
                    <img class="h-100 w-100 rounded" style="object-fit: cover; object-position: center"
                        src="{{ asset('img/telur.jpeg') }}" alt="Peternakan Andri Jaya Telor">
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 mb-2 ps-5">
                <h1 class="mb-3">Misi</h1>
                <ol style="font-size: 18px; text-align: justify">
                    <li>
                        Menjalankan praktik peternakan yang berkelanjutan untuk mendukung keberlanjutan sumber daya alam dan menjaga keseimbangan lingkungan.
                    </li>
                    
                    <li>
                        Memberikan layanan terbaik kepada pelanggan dengan memastikan produk kami tersedia dengan cepat dan memberikan informasi yang jelas tentang produk kami.</ol>
                    </li>
            </div>                
        </div>

        <div  class="row" style="margin-bottom: 100px">
            <div class="col-12 col-md-12 col-lg-5 mb-2 pe-5">
                <h1 class="mb-3">Tujuan</h1>
                <p style="font-size: 18px; text-align: justify">Peningkatan produktivitas adalah tujuan tambahan peternakan telurku untuk memenuhi permintaan pasar yang terus meningkat. Ini dapat mencakup meningkatkan jumlah telur yang diproduksi, meningkatkan efisiensi operasional, dan meningkatkan diversifikasi produk.</p>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div style="height: 400px">
                    <img class="h-100 w-100 rounded" style="object-fit: cover; object-position: center"
                        src="{{ asset('img/peternakan2.jpeg') }}" alt="Peternakan Andri Jaya Telor">
                </div>
            </div>
        </div>

    </div>
@endsection
