import { formBeforeSend, formSuccess, formError } from '../forms';

// Reset Password Form
const resetPassForm = document.getElementById('flr-blocks-reset-pass-form');
if (resetPassForm) {
	resetPassForm.addEventListener('submit', function (e) {
		e.preventDefault();
		const form = this;
		const formData = new FormData(form);
		const submitBtn = form.querySelector('#flr-blocks-reset-password-submit');
		const formResult = document.getElementById('flr-blocks-reset-password-form-result');
		const loadingBtn = document.getElementById('flr-blocks-reset-password-loading');

		// Access configuration data via global object
		const ajaxConfig = window.flr_blocks_ajax_object || {};

		if (!ajaxConfig.ajax_url) {
			console.error('AJAX URL not available');
			return;
		}

		// Form processing before sending
		formBeforeSend(formResult, submitBtn, loadingBtn);

		fetch(ajaxConfig.ajax_url, {
			method: 'POST',
			body: formData,
			credentials: 'include',
			headers: {
				'X-WP-Nonce': ajaxConfig.nonce || ''
			}
		})
			.then(response => response.json())
			.then(response => {
				formSuccess(response, formResult, submitBtn, loadingBtn);
			})
			.catch(error => {
				formError(error, formResult, submitBtn, loadingBtn);
			});
	});
}

// Lost password request form
const resetPassRequestForm = document.getElementById('flr-blocks-reset-pass-request-form');
if (resetPassRequestForm) {
	resetPassRequestForm.addEventListener('submit', function (e) {
		e.preventDefault();
		const form = this;
		const formData = new FormData(form);
		const submitBtn = form.querySelector('#flr-blocks-reset-request-submit');
		const formResult = document.getElementById('flr-blocks-reset-request-form-result');
		const loadingBtn = document.getElementById('flr-blocks-reset-request-loading');

		// Access configuration data via global object
		const ajaxConfig = window.flr_blocks_ajax_object || {};

		if (!ajaxConfig.ajax_url) {
			console.error('AJAX URL not available');
			return;
		}

		// Form processing before sending
		formBeforeSend(formResult, submitBtn, loadingBtn);

		fetch(ajaxConfig.ajax_url, {
			method: 'POST',
			body: formData,
			credentials: 'include',
			headers: {
				'X-WP-Nonce': ajaxConfig.nonce || ''
			}
		})
			.then(response => response.json())
			.then(response => {
				formSuccess(response, formResult, submitBtn, loadingBtn);
			})
			.catch(error => {
				formError(error, formResult, submitBtn, loadingBtn);
			});
	});
}

