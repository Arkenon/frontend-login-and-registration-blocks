import { formBeforeSend, formSuccess, formError } from '../forms';

// ES Module for Script Modules (WordPress 6.5+)
// Configuration data provided via wp_add_inline_script

// Login form
const loginForm = document.getElementById('flr-blocks-login-form');
if (loginForm) {
	loginForm.addEventListener('submit', async function (e) {
		e.preventDefault();
		const form = this;
		const formData = new FormData(form);
		const submitBtn = form.querySelector('#flr-blocks-login-submit');
		const formResult = document.getElementById(
			'flr-blocks-login-form-result'
		);
		const loadingBtn = document.getElementById(
			'flr-blocks-login-loading'
		);

		// Access configuration data via global object
		const ajaxConfig = window.flr_blocks_ajax_object || {};

		if (!ajaxConfig.ajax_url) {
			console.error('AJAX URL not available');
			return;
		}

		// Form processing before sending
		formBeforeSend(formResult, submitBtn, loadingBtn);

		try {
			const response = await fetch(ajaxConfig.ajax_url, {
				method: 'POST',
				body: formData,
				credentials: 'include',
				headers: {
					'X-WP-Nonce': ajaxConfig.nonce || ''
				}
			});

			const data = await response.json();
			formSuccess(data, formResult, submitBtn, loadingBtn);
		} catch (error) {
			formError(error, formResult, submitBtn, loadingBtn);
		}
	});
}
