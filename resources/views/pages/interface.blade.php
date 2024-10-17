@extends('template.app')

@section('content-dinamis')
<!-- Container for Carousel and Create Button -->
<div class="container-fluid p-5 bg-color-dark" style="border-bottom: 5px solid black;"> <!-- Increased padding from p-0 to p-4 -->
    <div class="row align-items-center"> <!-- Align items vertically in the center -->
        
        <!-- Create Button Section -->
        <div class="col-md-3 d-flex align-items-center justify-content-center"> <!-- Left side for the Create button -->
            <div style="color: white" align-item="center">
                <img src="{{ asset('images/logo-web2.png') }}" width="130" alt="logo-web">
                <p>Isi Ulang Sekarang untuk Pengalaman Lebih Seru!
                    Apakah Anda siap untuk meningkatkan pengalaman Anda? Dengan melakukan top-up, Anda bisa menikmati fitur eksklusif dan akses ke penawaran menarik yang tidak ingin Anda lewatkan. Segera isi saldo Anda dan bergabunglah dengan kami dalam petualangan ini!</p>
                <a href="{{ route('interface.create') }}" class="text-decoration-none">
                    <button class="btn custom-card" style="width: 100%; padding: 10px 15px; font-size: 0.9rem;"> <!-- Reduced padding and font size -->
                        <div class="card-body text-center">
                            <p class="card-text">Buy Now</p> <!-- Updated button text -->
                        </div>
                    </button>
                </a>
            </div>
        </div>

        <!-- Carousel Section -->
        <div class="col-md-9 d-flex justify-content-center"> <!-- Use flex to center the carousel -->
            <div id="carouselExample" class="carousel slide carousel-bg" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="text-end"> <!-- Aligns content to the right -->
                            <img src="{{ asset('images/Char1.webp') }}" class="d-block" style="height: 700px; object-fit: contain;" alt="Character 1">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="text-end"> <!-- Aligns content to the right -->
                            <img src="{{ asset('images/Char2.webp') }}" class="d-block" style="height: 700px; object-fit: contain;" alt="Character 2">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="text-end"> <!-- Aligns content to the right -->
                            <img src="{{ asset('images/Char3.webp') }}" class="d-block" style="height: 700px; object-fit: contain;" alt="Character 3">
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Data Item Section in Button Format -->
<div class="container-fluid p-3 bg-color-light">
    <div class="row justify-content-center">
        @if (count($Item) == 0)
            <p class="text-center">Data Pembelian Kosong</p>
        @else
            @foreach ($Item as $index => $item)
                <div class="col-md-3 mb-4"> <!-- Adjust the column size as needed -->
                    <div class="card custom-card-item shadow-sm" style="border: 1px solid #252C37;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Pembelian {{ $index + 1 }}</h5>
                            <p class="card-text"><strong>Paket:</strong> {{ $item['items'] }}</p>
                            <p class="card-text"><strong>Payment:</strong> {{ $item['payment'] }}</p>
                            <p class="card-text"><strong>Jumlah:</strong> {{ $item['jumlah'] }}</p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('interface.ubah', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger" onclick="showModalDelete('{{ $item['id'] }}', '{{ $item['items'] }}')">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<!-- Modal for Deleting Items -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="">
            <div class="modal-header">
                @csrf
                @method('DELETE')
                <h1 class="modal-title fs-5" id="exampleModalLabel">Membatalkan Pembelian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Membatalkan pesanan? <b id="nama_items"></b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-danger">Batalkan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('style')
<!-- Custom CSS for cards -->
<style>
    .custom-card {
        border-radius: 20px;
        height: auto; /* Allow height to adjust based on content */
        width: 80%; /* Set a smaller width for the button */
        background-color: #f8f9fa;
        text-align: center;
        padding: 10px 15px; /* Adjust padding */
        font-size: 0.9rem; /* Adjust font size */
    }

    .custom-card-item {
        border-radius: 15px;
        background-color: #f8f9fa;
        padding: 15px;
        transition: transform 0.2s; /* Smooth transition for hover effect */
    }

    .custom-card-item:hover {
        transform: scale(1.05); /* Slightly enlarge card on hover */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
    }

    .custom-card-item .card-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #252C37; /* Font color for the title */
    }

    .custom-card-item .card-text {
        font-size: 1rem;
        margin-bottom: 8px;
        color: #252C37; /* Font color for text */
    }

    .custom-card-item .btn {
        padding: 8px 20px;
        font-size: 1rem;
    }

    .carousel-item img {
        object-fit: cover;
        border-radius: 10px;
    }

    .bg-color-dark {
        background-color: #252C37;
    }
    
    .bg-color-light {
        background-color: #F8C617;
    }

    /* New style for the carousel background */
    .carousel-bg {
        padding: 20px 0; /* Optional: add some padding */
    }
</style>
@endpush

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function showModalDelete(id, name) {
        $('#nama_items').text(name);
        let url = "{{ route('interface.hapus', ':id') }}";
        url = url.replace(':id', id);
        $("form").attr("action", url);
        $('#exampleModal').modal('show');
    }
</script>
@endpush 