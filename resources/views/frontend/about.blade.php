@extends('frontend.master')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (\Session::has('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ \Session::get('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ \Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!--== About Area Start ==-->
<section id="about-area" class="p-9 bg-light">
    <div class="ruby-container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2>About LorlahTate</h2>
                    <p>Elegance rooted in Nigerian craftsmanship</p>
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-lg-6 order-lg-2">
                <img src="{{ asset('ruby/ruby/assets/img/about-image.jpeg') }}" alt="LorlahTate Craftsmanship" class="img-fluid rounded shadow">
                <!-- Replace with your own photo of the founder or bead-making process -->
            </div>
            <div class="col-lg-6 order-lg-1">
                <h3>Our Story</h3>
                <p>LorlahTate was born from a deep passion for bead-making in the vibrant heart of Nigeria. It all began in 2010, when our founder started crafting intricate, handmade jewelry pieces inspired by tradition, beauty, and personal expression.</p>

                <p>In 2015, a journey of exploration took us abroad, broadening horizons and enriching creative vision. Returning with fresh inspiration, we dove fully into the craft in 2017, honing skills and perfecting designs that blend timeless elegance with modern sophistication.</p>

                <p>A major milestone came in 2020, when we officially registered as <strong>LT Handicraft Enterprise</strong>—solidifying our commitment to quality, authenticity, and empowering women through exquisite accessories.</p>

                <p>Today, LorlahTate stands as a celebration of Nigerian heritage and artisanal excellence. Each piece is meticulously handcrafted with love, using premium materials to create necklaces, earrings, and more that tell a story of resilience, creativity, and royal charm. Whether it's a "Necklace for a Princess" or everyday elegance, our jewelry is designed to elevate your style and make you feel truly special.</p>

                <p>Thank you for being part of our journey. We can't wait to help you sparkle!</p>

                <a href="{{ route('shop') }}" class="btn-long-arrow">Shop Now</a>
            </div>
        </div>

        <!-- Mission & Vision Section -->
        <div class="row my-5 g-4">
            <div class="col-lg-6">
                <div class="text-center p-5 bg-white shadow rounded h-100">
                    <h3>Our Mission</h3>
                    <p class="lead">To craft exquisite, handmade beaded jewelry that celebrates Nigerian heritage and artisanal excellence, empowering women with timeless pieces that blend tradition with modern elegance, making every wearer feel like royalty.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center p-5 bg-white shadow rounded h-100">
                    <h3>Our Vision</h3>
                    <p class="lead">To become a globally recognized brand that preserves and promotes Nigerian bead-making traditions, inspiring confidence and cultural pride while delivering unparalleled beauty and quality to women worldwide.</p>
                </div>
            </div>
        </div>

        <!-- Craftsmanship Gallery Carousel -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <h3 class="text-center mb-4">Our Craftsmanship in Action</h3>
                <div class="imgage-gallery-carousel owl-carousel">
                    <div class="gallery-item">
                        <img src="{{ asset('ruby/ruby/assets/img/craft1.jpg') }}" alt="Handcrafted Nigerian Beaded Necklace" class="img-fluid rounded shadow">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('ruby/ruby/assets/img/craft2.jpg') }}" alt="Artisan Bead Selection" class="img-fluid rounded shadow">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('ruby/ruby/assets/img/craft3.jpg') }}" alt="Elegant Princess-Style Beaded Jewelry" class="img-fluid rounded shadow">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('ruby/ruby/assets/img/craft4.jpg') }}" alt="Traditional Coral Beads Craft" class="img-fluid rounded shadow">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('ruby/ruby/assets/img/craft5.jpg') }}" alt="Close-up of Colorful Handmade Beads" class="img-fluid rounded shadow">
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('ruby/ruby/assets/img/craft6.jpg') }}" alt="Woman Wearing LorlahTate Coral Jewelry" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== About Area End ==-->

@endsection
