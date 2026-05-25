document.addEventListener('DOMContentLoaded', () => {
	const mobileToggle = document.querySelector('.mobile-toggle');
	const primaryNav = document.querySelector('.primary-nav');
	const backdrop = document.querySelector('.backdrop');
	const panelButtons = document.querySelectorAll('.nav-trigger');
	const panels = document.querySelectorAll('.mega-panel');

	const closePanels = () => {
		panels.forEach((panel) => {
			panel.hidden = true;
		});
		backdrop.hidden = true;
	};

	const toggleMobileNav = () => {
		const isOpen = primaryNav.classList.toggle('is-open');
		mobileToggle.setAttribute('aria-expanded', String(isOpen));
		backdrop.hidden = !isOpen;
		if (!isOpen) {
			closePanels();
		}
	};

	mobileToggle?.addEventListener('click', toggleMobileNav);
	backdrop?.addEventListener('click', () => {
		primaryNav.classList.remove('is-open');
		mobileToggle?.setAttribute('aria-expanded', 'false');
		closePanels();
	});

	panelButtons.forEach((button) => {
		button.addEventListener('click', () => {
			const panelId = button.getAttribute('data-panel');
			const panel = document.querySelector(`[data-panel-content="${panelId}"]`);
			const isHidden = panel?.hidden ?? true;

			closePanels();
			if (panel && isHidden) {
				panel.hidden = false;
				backdrop.hidden = false;
			}
		});
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape') {
			primaryNav.classList.remove('is-open');
			mobileToggle?.setAttribute('aria-expanded', 'false');
			closePanels();
		}
	});
});
