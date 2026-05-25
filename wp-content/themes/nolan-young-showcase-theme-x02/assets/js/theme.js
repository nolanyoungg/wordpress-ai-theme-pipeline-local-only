document.addEventListener('DOMContentLoaded', () => {
	const mobileToggle = document.querySelector('.mobile-toggle');
	const primaryNav = document.querySelector('.primary-nav');
	const backdrop = document.querySelector('.backdrop');
	const triggers = document.querySelectorAll('.nav-trigger');
	const panels = document.querySelectorAll('.panel-card');

	const closePanels = () => {
		panels.forEach((panel) => {
			panel.hidden = true;
		});
		if (backdrop) {
			backdrop.hidden = true;
		}
	};

	const closeNav = () => {
		primaryNav?.classList.remove('is-open');
		mobileToggle?.setAttribute('aria-expanded', 'false');
	};

	mobileToggle?.addEventListener('click', () => {
		const isOpen = primaryNav?.classList.toggle('is-open') ?? false;
		mobileToggle.setAttribute('aria-expanded', String(isOpen));
		if (backdrop) {
			backdrop.hidden = !isOpen;
		}
		if (!isOpen) {
			closePanels();
		}
	});

	backdrop?.addEventListener('click', () => {
		closeNav();
		closePanels();
	});

	triggers.forEach((trigger) => {
		trigger.addEventListener('click', () => {
			const panelId = trigger.getAttribute('data-menu-item');
			const panel = panelId ? document.querySelector(`[data-panel-content="${panelId}"]`) : null;
			const shouldOpen = panel?.hidden ?? true;

			closePanels();
			if (shouldOpen && panel) {
				panel.hidden = false;
				if (backdrop) {
					backdrop.hidden = false;
				}
			}
		});
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape') {
			closeNav();
			closePanels();
		}
	});
});
