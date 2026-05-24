/* Nolan Showcase Theme X9 — preview JS (no libraries) */
(() => {
	'use strict';

	const q = (sel, ctx = document) => ctx.querySelector(sel);
	const qa = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));
	const esc = (val) => {
		const str = String(val || '');
		if (window.CSS && typeof window.CSS.escape === 'function') return window.CSS.escape(str);
		return str.replace(/[^a-zA-Z0-9_-]/g, '\\$&');
	};

	const isWithin = (el, container) => {
		if (!el || !container) return false;
		return el === container || container.contains(el);
	};

	const setAriaExpanded = (btn, expanded) => {
		if (!btn) return;
		btn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
	};

	const prefersReducedMotion = () => {
		try {
			return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		} catch {
			return false;
		}
	};

	function initHeaderScrolledState(root) {
		const header = q('.nolan-header', root);
		if (!header) return;

		const onScroll = () => {
			const scrolled = (window.scrollY || 0) > 10;
			header.classList.toggle('is-scrolled', scrolled);
		};

		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	function initPanels(menuRoot) {
		const panels = qa('[data-nolan-menu-panel]', menuRoot);

		const initPanel = (panelEl) => {
			const railItems = qa('[data-nolan-panel-tab]', panelEl);
			const contentItems = qa('[data-nolan-panel-content]', panelEl);
			if (!railItems.length || !contentItems.length) return;

			const setActive = (key) => {
				railItems.forEach((btn) => {
					const active = btn.dataset.nolanPanelTab === key;
					btn.classList.toggle('is-active', active);
					btn.setAttribute('aria-selected', active ? 'true' : 'false');
				});
				contentItems.forEach((pane) => pane.classList.toggle('is-active', pane.dataset.nolanPanelContent === key));
			};

			const firstKey = railItems[0]?.dataset.nolanPanelTab;
			if (firstKey) setActive(firstKey);

			railItems.forEach((btn) => {
				const key = btn.dataset.nolanPanelTab;
				const activate = () => key && setActive(key);
				btn.addEventListener('mouseenter', activate);
				btn.addEventListener('focus', activate);
				btn.addEventListener('click', activate);
				btn.addEventListener('keydown', (e) => {
					if (e.key === 'Enter' || e.key === ' ') {
						e.preventDefault();
						activate();
					}
				});
			});
		};

		panels.forEach(initPanel);
	}

	function initDesktopMenu(menuRoot) {
		const triggers = qa('[data-nolan-menu-trigger]', menuRoot);
		const panels = qa('[data-nolan-menu-panel]', menuRoot);
		const backdrop = q('[data-nolan-menu-backdrop]', menuRoot);
		if (!triggers.length || !panels.length) return { closeAll: () => {} };

		let openKey = null;

		const getPanel = (key) => q(`[data-nolan-menu-panel="${esc(key)}"]`, menuRoot);
		const getTrigger = (key) => q(`[data-nolan-menu-trigger="${esc(key)}"]`, menuRoot);

		const closeAll = () => {
			openKey = null;
			triggers.forEach((t) => {
				t.classList.remove('is-active');
				setAriaExpanded(t, false);
			});
			panels.forEach((p) => {
				p.classList.remove('is-open');
				p.classList.add('is-hidden');
			});
			if (backdrop) backdrop.hidden = true;
		};

		const open = (key) => {
			const panel = getPanel(key);
			const trigger = getTrigger(key);
			if (!panel || !trigger) return;

			if (openKey && openKey !== key) closeAll();

			openKey = key;
			triggers.forEach((t) => {
				const active = t === trigger;
				t.classList.toggle('is-active', active);
				setAriaExpanded(t, active);
			});
			panels.forEach((p) => {
				const active = p === panel;
				p.classList.toggle('is-open', active);
				p.classList.toggle('is-hidden', !active);
			});
			if (backdrop) backdrop.hidden = false;
		};

		const toggle = (key) => {
			if (!key) return;
			if (openKey === key) return closeAll();
			open(key);
		};

		triggers.forEach((btn) => {
			const key = btn.dataset.nolanMenuTrigger;
			btn.addEventListener('click', () => toggle(key));
			btn.addEventListener('keydown', (e) => {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					toggle(key);
				}
				if (e.key === 'Escape') {
					e.preventDefault();
					closeAll();
					btn.focus();
				}
			});
		});

		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape' && openKey) {
				e.preventDefault();
				const activeTrigger = openKey ? getTrigger(openKey) : null;
				closeAll();
				if (activeTrigger) activeTrigger.focus();
			}
		});

		document.addEventListener('pointerdown', (e) => {
			if (!openKey) return;
			const panel = openKey ? getPanel(openKey) : null;
			const trigger = openKey ? getTrigger(openKey) : null;
			if (isWithin(e.target, panel) || isWithin(e.target, trigger) || isWithin(e.target, menuRoot)) return;
			closeAll();
		});

		if (backdrop) backdrop.addEventListener('click', closeAll);

		return { closeAll };
	}

	function initMobileMenu(menuRoot) {
		const openBtn = q('[data-nolan-mobile-open]', menuRoot);
		const mobileMenu = q('[data-nolan-mobile-menu]', menuRoot);
		const closeBtn = q('[data-nolan-mobile-close]', menuRoot);
		const backdrop = q('[data-nolan-menu-backdrop]', menuRoot);
		if (!openBtn || !mobileMenu) return { close: () => {} };

		let isOpen = false;

		const setOpen = (next) => {
			isOpen = !!next;
			mobileMenu.classList.toggle('is-open', isOpen);
			mobileMenu.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
			setAriaExpanded(openBtn, isOpen);
			if (backdrop) backdrop.hidden = !isOpen;
			if (isOpen) {
				const focusTarget = q('a,button,[tabindex]:not([tabindex=\"-1\"])', mobileMenu);
				if (focusTarget) focusTarget.focus({ preventScroll: true });
			} else {
				openBtn.focus({ preventScroll: true });
			}
		};

		const open = () => setOpen(true);
		const close = () => setOpen(false);

		openBtn.addEventListener('click', () => (isOpen ? close() : open()));
		if (closeBtn) closeBtn.addEventListener('click', close);
		if (backdrop) backdrop.addEventListener('click', close);

		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape' && isOpen) {
				e.preventDefault();
				close();
			}
		});

		const triggers = qa('[data-nolan-mobile-trigger]', mobileMenu);
		triggers.forEach((t) => {
			const key = t.dataset.nolanMobileTrigger;
			const panel = key ? q(`[data-nolan-mobile-panel-content=\"${esc(key)}\"]`, mobileMenu) : null;
			if (!panel) return;

			const setExpanded = (expanded) => {
				t.setAttribute('aria-expanded', expanded ? 'true' : 'false');
				panel.hidden = !expanded;
			};

			setExpanded(false);
			t.addEventListener('click', () => setExpanded(t.getAttribute('aria-expanded') !== 'true'));
			t.addEventListener('keydown', (e) => {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					t.click();
				}
			});
		});

		if (prefersReducedMotion()) {
			mobileMenu.style.transition = 'none';
		}

		return { close };
	}

	function initWorkFilter(root) {
		const buttons = qa('.filter-nav__btn', root);
		const cards = qa('[data-work-card]', root);
		if (!buttons.length || !cards.length) return;

		const setFilter = (filter) => {
			buttons.forEach((b) => b.classList.toggle('is-active', b.dataset.filter === filter));
			cards.forEach((c) => {
				const cat = (c.getAttribute('data-cat') || '').toLowerCase();
				const show = filter === 'all' || cat === filter;
				c.dataset.hidden = show ? 'false' : 'true';
			});
		};

		buttons.forEach((btn) => btn.addEventListener('click', () => setFilter(btn.dataset.filter || 'all')));
	}

	function initSmoothAnchors(root) {
		if (prefersReducedMotion()) return;
		const links = qa('a[href^=\"#\"]', root);
		links.forEach((a) => {
			a.addEventListener('click', (e) => {
				const href = a.getAttribute('href') || '';
				if (href === '#' || href.length < 2) return;
				const target = q(href, document);
				if (!target) return;
				e.preventDefault();
				target.scrollIntoView({ behavior: 'smooth', block: 'start' });
			});
		});
	}

	function initReveal(root) {
		if (prefersReducedMotion()) {
			qa('[data-reveal]', root).forEach((el) => el.classList.add('is-in'));
			return;
		}
		if (!('IntersectionObserver' in window)) {
			qa('[data-reveal]', root).forEach((el) => el.classList.add('is-in'));
			return;
		}

		const obs = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting) return;
					entry.target.classList.add('is-in');
					obs.unobserve(entry.target);
				});
			},
			{ threshold: 0.12 }
		);

		qa('[data-reveal]', root).forEach((el) => obs.observe(el));
	}

	function initNolanMenu() {
		const menuRoot = q('[data-nolan-menu]');
		if (!menuRoot) return;

		initPanels(menuRoot);
		const desktop = initDesktopMenu(menuRoot);
		const mobile = initMobileMenu(menuRoot);

		window.addEventListener('resize', () => {
			mobile.close();
			desktop.closeAll();
		});
	}

	function ready(fn) {
		if (document.readyState !== 'loading') fn();
		else document.addEventListener('DOMContentLoaded', fn);
	}

	ready(() => {
		initHeaderScrolledState(document);
		initNolanMenu();
		initWorkFilter(document);
		initSmoothAnchors(document);
		initReveal(document);
	});
})();

