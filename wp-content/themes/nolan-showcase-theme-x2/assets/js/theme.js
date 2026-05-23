(function () {
	'use strict';

	var toggle = document.querySelector('[data-nav-toggle]');
	var nav = document.querySelector('[data-primary-nav]');

	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var isOpen = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});
	}

	var revealItems = Array.prototype.slice.call(document.querySelectorAll('.reveal'));
	var counters = Array.prototype.slice.call(document.querySelectorAll('[data-counter]'));
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	function runCounter(counter) {
		var target = parseInt(counter.getAttribute('data-counter'), 10) || 0;
		if (counter.dataset.counted === 'true') {
			return;
		}
		counter.dataset.counted = 'true';
		if (reduceMotion) {
			counter.textContent = String(target);
			return;
		}
		var start = 0;
		var duration = 900;
		var started = null;
		function tick(timestamp) {
			if (!started) {
				started = timestamp;
			}
			var progress = Math.min((timestamp - started) / duration, 1);
			counter.textContent = String(Math.round(start + (target - start) * progress));
			if (progress < 1) {
				window.requestAnimationFrame(tick);
			}
		}
		window.requestAnimationFrame(tick);
	}

	if ('IntersectionObserver' in window && !reduceMotion) {
		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					if (entry.target.hasAttribute('data-counter')) {
						runCounter(entry.target);
					}
					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.18 });

		revealItems.concat(counters).forEach(function (item) {
			observer.observe(item);
		});
	} else {
		revealItems.forEach(function (item) {
			item.classList.add('is-visible');
		});
		counters.forEach(runCounter);
	}

	var sections = Array.prototype.slice.call(document.querySelectorAll('main section[id]'));
	var navLinks = Array.prototype.slice.call(document.querySelectorAll('.nav-menu a[href*="#"]'));

	function setActiveNav() {
		var current = '';
		sections.forEach(function (section) {
			if (section.getBoundingClientRect().top <= 120) {
				current = section.id;
			}
		});
		navLinks.forEach(function (link) {
			var active = link.getAttribute('href').split('#').pop() === current;
			link.classList.toggle('is-active', active);
		});
	}
	window.addEventListener('scroll', setActiveNav, { passive: true });
	setActiveNav();

	document.querySelectorAll('[data-tilt-card]').forEach(function (card) {
		card.addEventListener('pointermove', function (event) {
			if (reduceMotion) {
				return;
			}
			var rect = card.getBoundingClientRect();
			var x = ((event.clientX - rect.left) / rect.width - 0.5) * 6;
			var y = ((event.clientY - rect.top) / rect.height - 0.5) * -6;
			card.style.transform = 'translateY(-4px) rotateX(' + y.toFixed(2) + 'deg) rotateY(' + x.toFixed(2) + 'deg)';
		});
		card.addEventListener('pointerleave', function () {
			card.style.transform = '';
		});
	});
}());
