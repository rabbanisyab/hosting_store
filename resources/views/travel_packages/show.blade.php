@extends('layouts.frontend')

@section('content')
 <!--==================== HOME ====================-->
      <section class="blog section" id="blog">
        <div class="blog__container container">
          <div class="content__container">
            <div class="blog__detail">
            {!! $travel_package->description !!}
            </div>
            <div class="package-travel">
              <h3>Order Now</h3>
              <div class="card">
              <form action="{{ route('payment.create') }}" method="POST">
                  @csrf
                  <input type="hidden" name="travel_package_id" value="{{ $travel_package->id }}">
                  <input type="text" name="name" placeholder="Nama" required>
                  <input type="email" name="email" placeholder="Email" required>
                  <input type="text" name="phone" placeholder="No HP" required>
                  <input type="date" name="payment_date" required>
                  <input type="hidden" name="total_price" value="{{ $travel_package->price }}">
                  <button type="submit" class="button button-booking">Bayar Sekarang</button>
              </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section" id="popular">
        <div class="container">
          <span class="section__subtitle" style="text-align: center"
            >Package Hosting</span
          >
          <h2 class="section__title" style="text-align: center">
            The Best Package For You
          </h2>

          <div class="popular__all">
            @foreach($travel_packages as $travel_package)
            <article class="popular__card">
              <a href="{{ route('travel_package.show', $travel_package->slug) }}">
               
                <div class="popular__data">
                  <h2 class="popular__price"><span>$</span>{{ number_format($travel_package->price,2) }}</h2>
                  <h3 class="popular__title">{{ $travel_package->location }}</h3>
                  <p class="popular__description">{{ $travel_package->type }}</p>
                </div>
              </a>
            </article>
            @endforeach
          </div>
        </div>
      </section>

    @if(session()->has('message'))
      <div id="alert" class="alert">
        {{ session()->get('message') }}
        <i class='bx bx-x alert-close' id="close"></i>
      </div>
    @endif
@endsection

@push('style-alt')
<style>
  .alert {
    position:absolute;
    top: 120px;
    left:0;
    right:0;
    background-color: var(--second-color);
    color: white;
    padding: 1rem;
    width: 70%;
    z-index: 99;
    margin: auto;
    border-radius: .25rem;
    text-align: center;
  }

  .alert-close {
    font-size: 1.5rem;
    color: #090909;
    position: absolute;
    top: .25rem;
    right: .5rem;
    cursor: pointer;
  }
  blockquote {
    border-left: 8px solid #b4b4b4;
    padding-left: 1rem;
  }
  .blog__detail ul li {
    list-style: initial;
  }
</style>
@endpush

@push('script-alt')
<script>
      let galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 0,
        slidesPerView: 0,
      });

      let galleryTop = new Swiper('.gallery-top', {
        effect: 'fade',
        loop: true,

        thumbs: {
          swiper: galleryThumbs,
        },
      });

      const close = document.getElementById('close');
      const alert = document.getElementById('alert');
      if(close) {
        close.addEventListener('click', function() {
          alert.style.display = 'none';
        })
      }
    </script>
@endpush