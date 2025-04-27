@extends('layout.home')

@section('content')
<div class="container-sm mt-5" style="height: 650px; overflow: hidden;">
    <div class="row">

        <div class="col-10">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 650px; overflow: hidden; border-radius: 10px;">
                <div class="carousel-inner" id="carouselItems" style="height: 100%;"></div>
            </div>
        </div>

        <div class="col-2" style="position: relative; overflow: hidden;">
            <div id="thumbnailCards" style="display: flex; flex-direction: column; overflow: hidden; white-space: nowrap; position: relative; height: 100%;"></div>
        </div>

    </div>
</div>

<style>

.thumbnail-active {
  position: relative;
  overflow: hidden;
}

.thumbnail-active::after {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  animation: sweepGray 5s linear infinite;
}
</style>
<style id="dynamic-keyframes">
  /* The gray animation keyframes will be generated and inserted here */
</style>

<script>
  const styleSheet = document.getElementById('dynamic-keyframes');
  const keyframes = ['@keyframes sweepGray {'];

  for (let i = 0; i <= 100; i++) {
    keyframes.push(`
      ${i}% {
        background: linear-gradient(to right, rgba(128,128,128,0.5) ${i}%, rgba(128,128,128,0) 0%);
      }
    `);
  }

  keyframes.push('}'); 

  styleSheet.innerHTML = keyframes.join('');

    const images = [
        'System_image/game1.jpg',
        'System_image/game2.jpg',
        'System_image/game3.jpg',
        'System_image/game4.jpg',
        'System_image/game5.jpg',
        'System_image/game6.jpg'
    ];

    const carouselItemsContainer = document.getElementById('carouselItems');
    const thumbnailCardsContainer = document.getElementById('thumbnailCards');

    images.forEach((image, index) => {
        const carouselItem = document.createElement('div');
        carouselItem.classList.add('carousel-item');
        if (index === 0) {
            carouselItem.classList.add('active');
        }

        const carouselImg = document.createElement('img');
        carouselImg.src = image;
        carouselImg.classList.add('d-block', 'w-100');
        carouselImg.style.objectFit = 'cover';
        carouselImg.style.height = '100%';
        carouselImg.style.borderRadius = '10px';
        carouselItem.appendChild(carouselImg);
        carouselItemsContainer.appendChild(carouselItem);

        const thumbnailCard = document.createElement('div');
        thumbnailCard.classList.add('card');
        thumbnailCard.style.maxHeight = '100px';
        thumbnailCard.style.overflow = 'hidden';
        thumbnailCard.style.marginBottom = '10px';
        thumbnailCard.style.borderRadius = '10px';
        thumbnailCard.style.cursor = 'pointer';
        thumbnailCard.style.position = 'relative';

        const thumbnailImg = document.createElement('img');
        thumbnailImg.src = image;
        thumbnailImg.classList.add('card-img-top');
        thumbnailImg.alt = '...';
        thumbnailImg.style.objectFit = 'cover';
        thumbnailImg.style.height = '100%';
        thumbnailImg.style.borderRadius = '10px';
        thumbnailImg.id = 'thumbnail-' + index;

        thumbnailImg.setAttribute('data-bs-target', '#mainCarousel');
        thumbnailImg.setAttribute('data-bs-slide-to', index.toString());

        thumbnailCard.appendChild(thumbnailImg);
        thumbnailCardsContainer.appendChild(thumbnailCard);
    });

    const mainCarousel = document.getElementById('mainCarousel');
    mainCarousel.addEventListener('slide.bs.carousel', function (event) {
        images.forEach((_, i) => {
            const thumb = document.getElementById('thumbnail-' + i).parentElement;
            thumb.classList.remove('thumbnail-active');
        });

        const activeIndex = event.to;
        const activeThumb = document.getElementById('thumbnail-' + activeIndex).parentElement;
        activeThumb.classList.add('thumbnail-active');
    });

    window.addEventListener('load', function () {
        const initialThumb = document.getElementById('thumbnail-0').parentElement;
        initialThumb.classList.add('thumbnail-active');
    });
</script>

@endsection
