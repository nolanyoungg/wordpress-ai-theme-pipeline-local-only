(function () {
	"use strict";

	function prefersReducedMotion() {
		return window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
	}

	function initNav() {
		var header = document.querySelector("[data-site-header]");
		var toggle = document.querySelector("[data-nav-toggle]");

		if (!header || !toggle) return;

		toggle.addEventListener("click", function () {
			var isOpen = header.classList.toggle("is-open");
			toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
		});

		document.addEventListener("click", function (event) {
			if (!header.classList.contains("is-open")) return;
			if (header.contains(event.target)) return;
			header.classList.remove("is-open");
			toggle.setAttribute("aria-expanded", "false");
		});

		document.addEventListener("keydown", function (event) {
			if (event.key !== "Escape") return;
			if (!header.classList.contains("is-open")) return;
			header.classList.remove("is-open");
			toggle.setAttribute("aria-expanded", "false");
			toggle.focus();
		});
	}

	function initReveal() {
		if (prefersReducedMotion()) return;

		var items = Array.prototype.slice.call(document.querySelectorAll(".reveal"));
		if (!items.length) return;

		document.documentElement.classList.add("js");

		if (!("IntersectionObserver" in window)) {
			items.forEach(function (el) {
				el.classList.add("is-visible");
			});
			return;
		}

		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (!entry.isIntersecting) return;
					entry.target.classList.add("is-visible");
					observer.unobserve(entry.target);
				});
			},
			{ threshold: 0.12 }
		);

		items.forEach(function (el) {
			observer.observe(el);
		});
	}

	document.addEventListener("DOMContentLoaded", function () {
		initNav();
		initReveal();
	});
})();

