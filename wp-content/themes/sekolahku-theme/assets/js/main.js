document.addEventListener( 'DOMContentLoaded', function () {

	/* ===== Toggle menu mobile ===== */
	var navToggle = document.getElementById( 'navToggle' );
	var siteNav = document.getElementById( 'site-nav' );
	var navOriginalParent = siteNav ? siteNav.parentElement : null;
	var navNextSibling = siteNav ? siteNav.nextSibling : null;
	var isPortaled = false;

	// === Backdrop overlay ===
	var backdrop = document.createElement( 'div' );
	backdrop.className = 'drawer-backdrop';
	document.body.appendChild( backdrop );

	function portalNavToBody() {
		if ( siteNav && !isPortaled && siteNav.parentElement !== document.body ) {
			document.body.appendChild( siteNav );
			isPortaled = true;
		}
	}

	function restoreNavToHeader() {
		if ( siteNav && isPortaled && navOriginalParent ) {
			if ( navNextSibling ) {
				navOriginalParent.insertBefore( siteNav, navNextSibling );
			} else {
				navOriginalParent.appendChild( siteNav );
			}
			isPortaled = false;
		}
	}

	function isMobile() {
		return window.innerWidth <= 768;
	}

	function handleLayout() {
		if ( isMobile() ) {
			portalNavToBody();
		} else {
			closeDrawer();
			restoreNavToHeader();
		}
	}

	// Run on load
	handleLayout();

	// Run on resize
	window.addEventListener( 'resize', handleLayout );

	function openDrawer() {
		if ( !isMobile() ) return;
		siteNav.classList.add( 'is-open' );
		backdrop.classList.add( 'is-active' );
		if ( navToggle ) navToggle.setAttribute( 'aria-expanded', 'true' );
		document.body.style.overflow = 'hidden';
	}

	function closeDrawer() {
		siteNav.classList.remove( 'is-open' );
		backdrop.classList.remove( 'is-active' );
		if ( navToggle ) navToggle.setAttribute( 'aria-expanded', 'false' );
		document.body.style.overflow = '';
	}

	if ( navToggle && siteNav ) {
		navToggle.addEventListener( 'click', function () {
			if ( siteNav.classList.contains( 'is-open' ) ) {
				closeDrawer();
			} else {
				openDrawer();
			}
		} );
	}

	// Close on backdrop click
	backdrop.addEventListener( 'click', closeDrawer );

	// Ensure drawerClose exists (fallback for cached WordPress HTML)
	if ( siteNav && !document.getElementById('drawerClose') ) {
		var closeBtn = document.createElement('button');
		closeBtn.type = 'button';
		closeBtn.className = 'drawer-close-btn';
		closeBtn.id = 'drawerClose';
		closeBtn.setAttribute('aria-label', 'Tutup menu');
		closeBtn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
		siteNav.insertBefore(closeBtn, siteNav.firstChild);
	}

	var drawerClose = document.getElementById( 'drawerClose' );
	if ( drawerClose && siteNav ) {
		drawerClose.addEventListener( 'click', closeDrawer );
	}

	// Inject icons into mobile drawer menu dynamically
	if ( siteNav ) {
		var menuLinks = siteNav.querySelectorAll( '.primary-menu > li > a' );
		menuLinks.forEach( function ( link ) {
			var text = link.textContent.trim().toLowerCase();
			var iconHtml = '';
			if ( text.includes( 'beranda' ) || text.includes( 'home' ) ) {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>';
			} else if ( text.includes( 'informasi' ) || text.includes( 'info' ) || text.includes( 'news' ) ) {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>';
			} else if ( text.includes( 'program' ) ) {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>';
			} else if ( text.includes( 'staf' ) || text.includes( 'guru' ) || text.includes( 'teacher' ) ) {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>';
			} else if ( text.includes( 'fasilitas' ) || text.includes( 'facility' ) ) {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"></path><path d="M3 7v1a3 3 0 0 0 6 0V7m0 0v1a3 3 0 0 0 6 0V7m0 0v1a3 3 0 0 0 6 0V7H3"></path><path d="M4 21V13h16v8"></path></svg>';
			} else if ( text.includes( 'ekskul' ) || text.includes( 'ekstrakurikuler' ) ) {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>';
			} else if ( text.includes( 'foto' ) || text.includes( 'video' ) || text.includes( 'galeri' ) ) {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>';
			} else if ( text.includes( 'kontak' ) || text.includes( 'contact' ) ) {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>';
			} else if ( text.includes( 'profil' ) || text.includes( 'about' ) ) {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>';
			} else {
				iconHtml = '<svg class="menu-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 8 12 12 16 14"></polyline></svg>';
			}
			link.innerHTML = iconHtml + '<span>' + link.textContent.trim() + '</span>';
		} );

		// Mobile sub-menu toggle
		var parentItems = siteNav.querySelectorAll( '.primary-menu .menu-item-has-children' );
		parentItems.forEach( function ( item ) {
			var link = item.querySelector( ':scope > a' );
			if ( link ) {
				link.addEventListener( 'click', function ( e ) {
					var href = link.getAttribute( 'href' );
					if ( !href || href === '#' || href === '' ) {
						e.preventDefault();
					}
					item.classList.toggle( 'is-submenu-open' );
				} );
			}
		} );
	}

	/* ===== Hero Slider ===== */
	var heroSlider = document.getElementById( 'heroSlider' );
	if ( heroSlider ) {
		var slides = heroSlider.querySelectorAll( '.hero-slide' );
		var prevBtn = document.getElementById( 'slidePrev' );
		var nextBtn = document.getElementById( 'slideNext' );
		var currentSlide = 0;
		var slideInterval;

		function showSlide( index ) {
			slides[currentSlide].classList.remove( 'active' );
			currentSlide = ( index + slides.length ) % slides.length;
			slides[currentSlide].classList.add( 'active' );
		}

		function nextSlide() {
			showSlide( currentSlide + 1 );
		}

		function prevSlide() {
			showSlide( currentSlide - 1 );
		}

		if ( prevBtn && nextBtn ) {
			prevBtn.addEventListener( 'click', function () {
				prevSlide();
				resetInterval();
			} );
			nextBtn.addEventListener( 'click', function () {
				nextSlide();
				resetInterval();
			} );
		}

		function startInterval() {
			slideInterval = setInterval( nextSlide, 5000 );
		}

		function resetInterval() {
			clearInterval( slideInterval );
			startInterval();
		}

		startInterval();

		heroSlider.addEventListener( 'mouseenter', function () {
			clearInterval( slideInterval );
		} );
		heroSlider.addEventListener( 'mouseleave', function () {
			startInterval();
		} );
	}

	/* ===== Lightbox galeri sederhana (tanpa library eksternal) ===== */
	var lightbox = document.getElementById( 'sekolahkuLightbox' );
	var lightboxImage = document.getElementById( 'lightboxImage' );
	var lightboxCaption = document.getElementById( 'lightboxCaption' );
	var lightboxClose = document.getElementById( 'lightboxClose' );
	var galleryLinks = document.querySelectorAll( '[data-lightbox="galeri"]' );

	if ( lightbox && galleryLinks.length ) {
		galleryLinks.forEach( function ( link ) {
			link.addEventListener( 'click', function ( e ) {
				e.preventDefault();
				lightboxImage.src = link.getAttribute( 'href' );
				lightboxCaption.textContent = link.getAttribute( 'data-title' ) || '';
				lightbox.classList.add( 'is-open' );
			} );
		} );

		lightboxClose.addEventListener( 'click', function () {
			lightbox.classList.remove( 'is-open' );
		} );

		lightbox.addEventListener( 'click', function ( e ) {
			if ( e.target === lightbox ) {
				lightbox.classList.remove( 'is-open' );
			}
		} );
	}

	/* ===== Animasi angka statistik saat elemen terlihat ===== */
	var statNumbers = document.querySelectorAll( '.stat-number' );

	if ( statNumbers.length && 'IntersectionObserver' in window ) {
		var observer = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					entry.target.style.opacity = '1';
					observer.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.4 } );

		statNumbers.forEach( function ( el ) {
			el.style.transition = 'opacity .6s ease';
			el.style.opacity = '0';
			observer.observe( el );
		} );
	}

} );
