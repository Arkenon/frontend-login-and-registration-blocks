import { formBeforeSend, formSuccess, formError } from '../forms';

// User Settings Form
const userSettingsForm = document.getElementById('flr-blocks-user-settings-form');
if (userSettingsForm) {
	userSettingsForm.addEventListener('submit', function (e) {
		e.preventDefault();
		const form = this;
		const formData = new FormData(form);
		const submitBtn = form.querySelector('#flr-blocks-user-settings-submit');
		const formResult = document.getElementById('flr-blocks-user-settings-form-result');
		const loadingBtn = document.getElementById('flr-blocks-user-settings-loading');

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
