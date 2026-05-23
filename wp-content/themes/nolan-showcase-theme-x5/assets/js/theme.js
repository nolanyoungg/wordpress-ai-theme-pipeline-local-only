(function () {
	"use strict";

	var header = document.querySelector("[data-site-header]");
	var navToggle = document.querySelector("[data-nav-toggle]");
	var primaryNav = document.querySelector("[data-primary-nav]");
	var revealNodes = Array.prototype.slice.call(document.querySelectorAll(".reveal"));
	var filterButtons = Array.prototype.slice.call(document.querySelectorAll("[data-filter]"));
	var portfolioCards = Array.prototype.slice.call(document.querySelectorAll("[data-portfolio-grid] [data-tags]"));
	var prefersReducedMotion = false;

	try {
		prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
	} catch (e) {
		prefersReducedMotion = false;
	}

	document.documentElement.classList.add("has-js");

	function setNavState(isOpen) {
		if (!primaryNav || !navToggle) {
			return;
		}
		primaryNav.classList.toggle("is-open", isOpen);
		navToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
	}

	if (navToggle && primaryNav) {
		navToggle.addEventListener("click", function () {
			var isOpen = primaryNav.classList.contains("is-open");
			setNavState(!isOpen);
		});

		document.addEventListener("keydown", function (event) {
			if (event.key === "Escape") {
				setNavState(false);
			}
		});

		document.addEventListener("click", function (event) {
			if (!primaryNav.classList.contains("is-open")) {
				return;
			}
			if (primaryNav.contains(event.target) || navToggle.contains(event.target)) {
				return;
			}
			setNavState(false);
		});
	}

	function onScroll() {
		if (!header) {
			return;
		}
		header.classList.toggle("is-sticky", window.scrollY > 10);
	}
	window.addEventListener("scroll", onScroll, { passive: true });
	onScroll();

	document.addEventListener("click", function (event) {
		var link = event.target.closest("a[href^=\"#\"]");
		if (!link) {
			return;
		}
		var href = link.getAttribute("href");
		if (!href || href.length < 2) {
			return;
		}
		var target = document.querySelector(href);
		if (!target) {
			return;
		}
		event.preventDefault();
		target.scrollIntoView({ behavior: prefersReducedMotion ? "auto" : "smooth", block: "start" });
		setNavState(false);
	});

	function setFilterActive(button, isActive) {
		if (!button) {
			return;
		}
		button.classList.toggle("is-active", isActive);
		button.setAttribute("aria-pressed", isActive ? "true" : "false");
	}

	function applyPortfolioFilter(filterValue) {
		var filter = filterValue || "all";
		portfolioCards.forEach(function (card) {
			var tags = (card.getAttribute("data-tags") || "").split(/\s+/).filter(Boolean);
			var shouldShow = filter === "all" || tags.indexOf(filter) >= 0;
			card.classList.toggle("is-hidden", !shouldShow);
		});
	}

	if (filterButtons.length && portfolioCards.length) {
		filterButtons.forEach(function (button) {
			button.addEventListener("click", function () {
				var value = button.getAttribute("data-filter") || "all";
				filterButtons.forEach(function (b) {
					setFilterActive(b, b === button);
				});
				applyPortfolioFilter(value);
			});
		});
	}

	if (prefersReducedMotion) {
		revealNodes.forEach(function (node) {
			node.classList.add("is-visible");
		});
		return;
	}

	if ("IntersectionObserver" in window) {
		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (!entry.isIntersecting) {
						return;
					}
					entry.target.classList.add("is-visible");
					observer.unobserve(entry.target);
				});
			},
			{ threshold: 0.14 }
		);
		revealNodes.forEach(function (node) {
			observer.observe(node);
		});
	} else {
		revealNodes.forEach(function (node) {
			node.classList.add("is-visible");
		});
	}
})();

