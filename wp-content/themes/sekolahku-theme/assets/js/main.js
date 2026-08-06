document.addEventListener( 'DOMContentLoaded', function () {

	/* ===== Toggle menu mobile ===== */
	var navToggle = document.getElementById( 'navToggle' );
	var siteNav = document.getElementById( 'site-nav' );

	if ( navToggle && siteNav ) {
		navToggle.addEventListener( 'click', function () {
			var isOpen = siteNav.classList.toggle( 'is-open' );
			navToggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
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
