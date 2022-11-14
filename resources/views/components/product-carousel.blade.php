{{-- product carousel with alpine and tailwind swipper --}}
{{-- main $image , decode array $gallery --}}

@props(['gallery', 'image'])

@php
    $gallery = json_decode($gallery);
@endphp

<div class="relative mb-10">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <img src="{{ asset('images/products/' . $image) }}" alt="product image" class="w-full h-full object-cover">
            </div>

            @if ($gallery)
                @foreach ($gallery as $item)
                    <div class="swiper-slide">
                        <img src="{{ asset('images/products/' . $item) }}" alt="product image"
                            class="w-full h-full object-cover">
                    </div>
                @endforeach
            @endif
        </div>
        
        <div class="swiper-pagination"></div>

        
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>

@push('scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush