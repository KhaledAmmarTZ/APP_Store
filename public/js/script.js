window.addEventListener('DOMContentLoaded', () => {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const body = document.body;
    const navbar = document.querySelector('.navbar');
    const footer = document.querySelector('footer');
    const themeToggle = document.getElementById('themeToggle');
    const offcanvas = document.querySelector('.offcanvas');
    const themeLinks = document.querySelectorAll('.theme-link');
    const modalBody = document.querySelector('.modal-rules');

    function applyTheme(isDark) {
        if (isDark) {
            body.classList.add('dark-mode');
            body.style.backgroundColor = '#101014';
            body.style.color = '#ffffff';

            navbar.classList.remove('bg-light');
            navbar.classList.add('bg-dark');
            navbar.classList.remove('navbar-light');
            navbar.classList.add('navbar-dark');

            footer.classList.remove('bg-light');
            footer.classList.add('bg-dark');
            footer.style.color = '#ffffff';

            themeToggle.classList.remove('bi-brightness-high');
            themeToggle.classList.add('bi-moon-stars-fill');
            themeToggle.classList.remove('text-dark');
            themeToggle.classList.add('text-warning');

            offcanvas.style.backgroundColor = 'rgba(16, 16, 20, 0.5)';
            offcanvas.style.color = '#ffffff';

            themeLinks.forEach(link => {
                link.style.color = '#ffffff';
            });

            // Modal rules dark style
            if (modalBody) {
                modalBody.style.backgroundColor = '#1e1e2f';
                modalBody.style.color = '#ffffff';
            }

        } else {
            body.classList.remove('dark-mode');
            body.style.backgroundColor = '#ffffff';
            body.style.color = '#000000';

            navbar.classList.remove('bg-dark');
            navbar.classList.add('bg-light');
            navbar.classList.remove('navbar-dark');
            navbar.classList.add('navbar-light');

            footer.classList.remove('bg-dark');
            footer.classList.add('bg-light');
            footer.style.color = '#000000';

            themeToggle.classList.remove('bi-moon-stars-fill');
            themeToggle.classList.add('bi-brightness-high');
            themeToggle.classList.remove('text-warning');
            themeToggle.classList.add('text-dark');

            offcanvas.style.backgroundColor = 'rgba(255, 255, 255, 0.6)';
            offcanvas.style.color = '#000000';

            themeLinks.forEach(link => {
                link.style.color = '#000000';
            });

            // Modal rules light style
            if (modalBody) {
                modalBody.style.backgroundColor = '#ffffff';
                modalBody.style.color = '#000000';
            }
        }
    }

    applyTheme(prefersDark);

    themeToggle.addEventListener('click', () => {
        const isDark = body.classList.contains('dark-mode');
        applyTheme(!isDark);
    });
});


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

const products = window.featuredProductData || [];

const carouselItemsContainer = document.getElementById('carouselItems');
const thumbnailCardsContainer = document.getElementById('thumbnailCards');

products.forEach((product, index) => {
    const carouselItem = document.createElement('div');
    carouselItem.classList.add('carousel-item');
    if (index === 0) {
        carouselItem.classList.add('active');
    }

    // Create link
    const link = document.createElement('a');
    link.href = `/products/${product.id}`; // Adjust route 

    // Create image
    const carouselImg = document.createElement('img');
    carouselImg.src = product.image;
    carouselImg.classList.add('d-block', 'w-100');
    carouselImg.style.objectFit = 'cover';
    carouselImg.style.height = '100%';
    carouselImg.style.borderRadius = '1px';

    link.appendChild(carouselImg);
    carouselItem.appendChild(link);
    carouselItemsContainer.appendChild(carouselItem);

    // Thumbnails (optional)
    const thumbnailCard = document.createElement('div');
    thumbnailCard.classList.add('card');
    thumbnailCard.style.maxHeight = '120px';
    thumbnailCard.style.overflow = 'hidden';
    thumbnailCard.style.marginBottom = '5px';
    thumbnailCard.style.cursor = 'pointer';
    thumbnailCard.style.position = 'relative';
    thumbnailCard.style.borderColor = 'transparent';

    const thumbnailImg = document.createElement('img');
    thumbnailImg.src = product.image;
    thumbnailImg.classList.add('card-img-top');
    thumbnailImg.alt = '...';
    thumbnailImg.style.objectFit = 'cover';
    thumbnailImg.style.height = '100%';
    thumbnailImg.id = 'thumbnail-' + index;

    thumbnailImg.setAttribute('data-bs-target', '#mainCarousel');
    thumbnailImg.setAttribute('data-bs-slide-to', index.toString());

    thumbnailCard.appendChild(thumbnailImg);
    thumbnailCardsContainer.appendChild(thumbnailCard);
});

const mainCarousel = document.getElementById('mainCarousel');
mainCarousel.addEventListener('slide.bs.carousel', function (event) {
    products.forEach((_, i) => {
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


// Search Modal Script 
document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.getElementById('searchModal');
    const modal = new bootstrap.Modal(modalElement);
    const modalInput = document.getElementById('modalSearchInput');
    const mainInput = document.querySelector('form.d-sm-flex input[name="query"]');

    modalInput.addEventListener('input', () => mainInput.value = modalInput.value);
    mainInput.addEventListener('input', () => modalInput.value = mainInput.value);
    window.addEventListener('resize', function () {
        const isSmallScreen = window.innerWidth < 576;
        if (!isSmallScreen && modalElement.classList.contains('show')) {
            modal.hide();
            if (modalInput.value.trim() !== '') {
                mainInput.value = modalInput.value.trim();
            }
        }
    });
    const modalForm = document.getElementById('modalSearchForm');
    modalForm.addEventListener('submit', function () {
        modal.hide();
    });
});
// Back to Top Button Script
document.getElementById('backToTopButton').addEventListener('click', function () {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});