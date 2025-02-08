@extends('layouts.frontend')

@section('content')
 <!--==================== HOME ====================-->
 <section>
        <div class="swiper-container gallery-top">
          <div class="swiper-wrapper">
            <section class="islands swiper-slide">
              <img src="{{ asset('frontend/assets/img/hero.jpg') }}" alt="" class="islands__bg" />
            </section>
          </div>
        </div>
      </section>

      <!--==================== POPULAR ====================-->
      <section class="section" id="popular">
    <div class="container">
        <span class="section__subtitle" style="text-align: center">All</span>
        <h2 class="section__title" style="text-align: center">
            Package Hosting
        </h2>

        <div class="popular__container swiper">
            <div class="swiper-wrapper">
                @foreach($travel_packages as $travel_package)
                    <article class="popular__card swiper-slide">
                        
                            <div class="popular__data">
                                <h2 class="popular__price">
                                    <span>Rp.</span>{{ number_format($travel_package->price,2) }}
                                </h2>
                                <h3 class="popular__title">
                                    {{ $travel_package->location }}
                                </h3>
                                <p class="popular__description">{{ $travel_package->type }}</p>
                            </div>
                       
                        <div class="popular__button-container" style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('travel_package.show', $travel_package->slug) }}" class="popular__button">
                                Pilih Paket
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="swiper-button-next">
                <i class="bx bx-chevron-right"></i>
            </div>
            <div class="swiper-button-prev">
                <i class="bx bx-chevron-left"></i>
            </div>
        </div>
    </div>
</section>

<style>
    .popular__button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .popular__button:hover {
        background-color: #0056b3;
    }
</style>


@endsection