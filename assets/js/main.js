/**
* Template Name: Medicio - v4.7.0
* Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  let selectTopbar = select('#topbar')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.add('topbar-scrolled')
        }
      } else {
        selectHeader.classList.remove('header-scrolled')
        if (selectTopbar) {
          selectTopbar.classList.remove('topbar-scrolled')
        }
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
   * Preloader
   */
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }

  /**
   * Hero carousel indicators
   */
  let heroCarouselIndicators = select("#hero-carousel-indicators")
  let heroCarouselItems = select('#heroCarousel .carousel-item', true)

  heroCarouselItems.forEach((item, index) => {
    (index === 0) ?
    heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "' class='active'></li>":
      heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "'></li>"
  });

  /**
   * Testimonials slider
   */

  let is_testimonials_here = select('.testimonials-slider')
  if(is_testimonials_here){
    new Swiper('.testimonials-slider', {
      speed: 600,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false
      },
      slidesPerView: 'auto',
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
  
        1200: {
          slidesPerView: 3,
          spaceBetween: 20
        }
      }
    });
  }

  

  /**
   * Clients Slider
   */
   let is_gallery_here = select('.gallery-slider')
   if(is_gallery_here){
    new Swiper('.gallery-slider', {
      speed: 400,
      loop: true,
      centeredSlides: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false
      },
      slidesPerView: 'auto',
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 20
        },
        640: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        992: {
          slidesPerView: 5,
          spaceBetween: 20
        }
      }
    });

    /**
   * Initiate gallery lightbox 
   */
  const galleryLightbox = GLightbox({
    selector: '.gallery-lightbox'
  });

   }

  

  

  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    })
  });

})()

// new stuff added here

var gen_author_id_field = function () {
  var no = document.getElementById('no_of_authors').value;
  if(no<1 || no>20) return;
  document.getElementById('id_par').innerHTML = '';
  for(var cnt=1;cnt<=no;cnt++) {
    var def_input = document.getElementById('id_node_def').cloneNode(true);
    def_input.id = 'id_node' + cnt;
    def_input.style.display = 'block';
    def_input.children[0].for = 'sorfid'+cnt;
    def_input.children[1].id = 'sorfid'+cnt;
    def_input.children[1].name = 'sorfid'+cnt;
    def_input.children[1].placeholder = 'Author '+cnt;
    
    def_input.children[2].children[0].id = 'student'+cnt;
    def_input.children[2].children[0].name = 'acc_type'+cnt;
    def_input.children[2].children[1].for = 'student'+cnt;

    def_input.children[3].children[0].id = 'faculty'+cnt;
    def_input.children[3].children[0].name = 'acc_type'+cnt;
    def_input.children[3].children[1].for = 'faculty'+cnt;

    def_input.children[4].children[0].id = 'alumni'+cnt;
    def_input.children[4].children[0].name = 'acc_type'+cnt;
    def_input.children[4].children[1].for = 'alumni'+cnt;
    
    document.getElementById('id_par').appendChild(def_input);
  }
}

var gen_award_field = function () {
  var no = document.getElementById('no_of_awards').value;
  if(no<1 || no>20) return;
  document.getElementById('award_par').innerHTML = '';
  for(var cnt=1;cnt<=no;cnt++) {
    var def_input = document.getElementById('award_def').cloneNode(true);
    def_input.id = 'award_n' + cnt;
    def_input.style.display = 'block';
    def_input.children[0].for = 'award'+cnt;
    def_input.children[1].id = 'award'+cnt;
    def_input.children[1].name = 'award'+cnt;
    def_input.children[1].placeholder = 'Award '+cnt;
    document.getElementById('award_par').appendChild(def_input);
  }
}

var show_form = function () {
  if(document.getElementById('conf').checked) {
    Array.from(document.getElementsByClassName('conf')).forEach(node => {
      node.style.display = 'block';
      node.children[1].setAttribute('required','');
    });
    var cnt=1;
    Array.from(document.getElementsByClassName('jour')).forEach(node => {
      node.style.display = 'none';
      if(cnt==2) node.children[2].children[0].removeAttribute('required');
      else node.children[1].removeAttribute('required');
      cnt++;
    });
  }
  else {
    Array.from(document.getElementsByClassName('conf')).forEach(node => {
      node.style.display = 'none';
      node.children[1].removeAttribute('required');
    });
    var cnt=1;
    Array.from(document.getElementsByClassName('jour')).forEach(node => {
      node.style.display = 'block';
      if(cnt==2) node.children[2].children[0].setAttribute('required','');
      else node.children[1].setAttribute('required','');
      cnt++;
    });
  }
}

window.addEventListener('DOMContentLoaded', event => {

  console.log('doc loaded');

  // Navbar shrink function
  var navbarShrink = function () {
      const navbarCollapsible = document.body.querySelector('#mainNav');
      if (!navbarCollapsible) {
          return;
      }
      if (window.scrollY === 0) {
          navbarCollapsible.classList.remove('navbar-shrink')
      } else {
          navbarCollapsible.classList.add('navbar-shrink')
      }

  };

  
  // Shrink the navbar 
  navbarShrink();

  // Shrink the navbar when page is scrolled
  document.addEventListener('scroll', navbarShrink);

  // document.getElementById('searcher').addEventListener("keyup", function(event) {
  //     if (event.key === "Enter") {
  //       event.preventDefault();
  //       getSearchVal();
  //     }
  //   }); 

  // Activate Bootstrap scrollspy on the main nav element
  const mainNav = document.body.querySelector('#mainNav');
  if (mainNav) {
      new bootstrap.ScrollSpy(document.body, {
          target: '#mainNav',
          offset: 74,
      });
  };

  // Collapse responsive navbar when toggler is visible
  const navbarToggler = document.body.querySelector('.navbar-toggler');
  const responsiveNavItems = [].slice.call(
      document.querySelectorAll('#navbarResponsive .nav-link')
  );
  responsiveNavItems.map(function (responsiveNavItem) {
      responsiveNavItem.addEventListener('click', () => {
          if (window.getComputedStyle(navbarToggler).display !== 'none') {
              navbarToggler.click();
          }
      });
  });
 
  //back-to-top
  if(document.getElementById('btn-back-to-top')!=null){
    //Get the button
    let mybutton = document.getElementById("btn-back-to-top");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
    scrollFunction();
    };

    function scrollFunction() {
    if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
    ) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
    }
    // When the user clicks on the button, scroll to the top of the document
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    }
  }

  if(document.title == 'Research Paper Form') {
    show_form();
  }
  else console.log(document.title);

});