// Loading

window.addEventListener('load', () => {

    const loader = document.querySelector('.loader');

    if(loader){
        loader.classList.add('hidden');
    }

});

// Navbar Effect

window.addEventListener('scroll', () => {

    const nav = document.querySelector('nav');

    if(!nav) return;

    if(window.scrollY > 50){
        nav.classList.add('nav-scrolled');
    }else{
        nav.classList.remove('nav-scrolled');
    }

});

// Reveal Animation

const reveals = document.querySelectorAll('.reveal');

function revealElement(){

    reveals.forEach(el => {

        const top = el.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if(top < windowHeight - 100){
            el.classList.add('active');
        }

    });

}

window.addEventListener('scroll', revealElement);
revealElement();

// Counter Animation

const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {

    const update = () => {

        const target = +counter.dataset.target;
        const current = +counter.innerText;

        const increment = target / 80;

        if(current < target){

            counter.innerText =
                Math.ceil(current + increment);

            setTimeout(update, 20);

        }else{

            counter.innerText = target;

        }

    };

    update();

});

// Parallax Hero

window.addEventListener('scroll', () => {

    const image = document.querySelector('.hero-image');

    if(!image) return;

    let value = window.scrollY * 0.2;

    image.style.transform =
        `translateY(${value}px)`;

});

// Active Link

const links =
document.querySelectorAll('nav a');

links.forEach(link => {

    link.addEventListener('click', () => {

        links.forEach(l =>
            l.classList.remove('font-bold')
        );

        link.classList.add('font-bold');

    });

});

// Back To Top

const topBtn =
document.createElement('button');

topBtn.innerHTML = '↑';

topBtn.style.position = 'fixed';
topBtn.style.bottom = '30px';
topBtn.style.right = '30px';
topBtn.style.width = '50px';
topBtn.style.height = '50px';
topBtn.style.borderRadius = '50%';
topBtn.style.border = 'none';
topBtn.style.cursor = 'pointer';
topBtn.style.display = 'none';
topBtn.style.zIndex = '999';
topBtn.style.fontSize = '20px';
topBtn.style.background = '#d97706';
topBtn.style.color = '#fff';

document.body.appendChild(topBtn);

window.addEventListener('scroll', () => {

    if(window.scrollY > 300){
        topBtn.style.display = 'block';
    }else{
        topBtn.style.display = 'none';
    }

});

topBtn.addEventListener('click', () => {

    window.scrollTo({
        top:0,
        behavior:'smooth'
    });

});

// Mouse Glow

document.addEventListener('mousemove', (e)=>{

    const glow =
    document.querySelector('.mouse-glow');

    if(!glow) return;

    glow.style.left = e.clientX + 'px';
    glow.style.top = e.clientY + 'px';

});

// Mobile menu toggle
const mobileBtn = document.getElementById('mobileMenuBtn');
const mobileMenu = document.getElementById('mobileMenu');

if(mobileBtn && mobileMenu){
    mobileBtn.addEventListener('click', () => {
        const expanded = mobileBtn.getAttribute('aria-expanded') === 'true';
        mobileBtn.setAttribute('aria-expanded', String(!expanded));
        mobileMenu.classList.toggle('hidden');
        // simple animation
        if(!mobileMenu.classList.contains('hidden')){
            mobileMenu.style.opacity = 0;
            requestAnimationFrame(()=>{ mobileMenu.style.transition = 'opacity .18s ease'; mobileMenu.style.opacity = 1; });
        }
    });
}