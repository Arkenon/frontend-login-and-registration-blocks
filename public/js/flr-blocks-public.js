/* global flr_blocks_ajax_object */
/* eslint-disable camelcase */

// Login form
const loginForm = document.getElementById('flr-blocks-login-form');
if (loginForm) {
	loginForm.addEventListener('submit', function (e) {
		e.preventDefault();
		const form = this;
		const formData = new FormData(form);
		const submitBtn = form.querySelector('#flr-blocks-login-submit');
		const formResult = document.getElementById('flr-blocks-login-form-result');
		const loadingBtn = document.getElementById('flr-blocks-login-loading');

		fetch(flr_blocks_ajax_object.ajax_url, {
			method: 'POST',
			body: formData,
			credentials: 'include'
		})
			.then(response => response.json())
			.then(response => {
				formSuccess(response, formResult, submitBtn, loadingBtn);
			})
			.catch(error => {
				formError(error, formResult, submitBtn, loadingBtn);
			});

		formBeforeSend(formResult, submitBtn, loadingBtn);
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

		fetch(flr_blocks_ajax_object.ajax_url, {
			method: 'POST',
			body: formData,
			credentials: 'include'
		})
			.then(response => response.json())
			.then(response => {
				formSuccess(response, formResult, submitBtn, loadingBtn);
			})
			.catch(error => {
				formError(error, formResult, submitBtn, loadingBtn);
			});

		formBeforeSend(formResult, submitBtn, loadingBtn);
	});
}

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

		fetch(flr_blocks_ajax_object.ajax_url, {
			method: 'POST',
			body: formData,
			credentials: 'include'
		})
			.then(response => response.json())
			.then(response => {
				formSuccess(response, formResult, submitBtn, loadingBtn);
			})
			.catch(error => {
				formError(error, formResult, submitBtn, loadingBtn);
			});

		formBeforeSend(formResult, submitBtn, loadingBtn);
	});
}

// Registration Form
const registerForm = document.getElementById('flr-blocks-register-form');
if (registerForm) {
	registerForm.addEventListener('submit', function (e) {
		e.preventDefault();
		const form = this;
		const formData = new FormData(form);
		const submitBtn = form.querySelector('#flr-blocks-register-submit');
		const formResult = document.getElementById('flr-blocks-register-form-result');
		const loadingBtn = document.getElementById('flr-blocks-register-loading');

		fetch(flr_blocks_ajax_object.ajax_url, {
			method: 'POST',
			body: formData,
			credentials: 'include'
		})
			.then(response => response.json())
			.then(response => {
				formSuccess(response, formResult, submitBtn, loadingBtn);
			})
			.catch(error => {
				formError(error, formResult, submitBtn, loadingBtn);
			});

		formBeforeSend(formResult, submitBtn, loadingBtn);
	});
}

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

		fetch(flr_blocks_ajax_object.ajax_url, {
			method: 'POST',
			body: formData,
			credentials: 'include'
		})
			.then(response => response.json())
			.then(response => {
				formSuccess(response, formResult, submitBtn, loadingBtn);
			})
			.catch(error => {
				formError(error, formResult, submitBtn, loadingBtn);
			});

		formBeforeSend(formResult, submitBtn, loadingBtn);
	});
}

function formBeforeSend(formResult, submitBtn, loadingBtn) {
	if (loadingBtn) {
		loadingBtn.classList.remove('flr-blocks-hide');
	}
	if (formResult) {
		formResult.innerHTML = '';
		formResult.classList.remove('flr-blocks-success', 'flr-blocks-danger');
	}
	if (submitBtn) {
		submitBtn.disabled = true;
	}
}

function formSuccess(response, formResult, submitBtn, loadingBtn) {
	if (formResult) {
		if (response.status) {
			formResult.classList.add('flr-blocks-success');
		} else {
			formResult.classList.add('flr-blocks-danger');
		}
		formResult.innerHTML = response.message;
	}

	if (loadingBtn) {
		loadingBtn.classList.add('flr-blocks-hide');
	}

	if (submitBtn) {
		submitBtn.disabled = false;
	}

	if (response.return_url !== null && response.return_url !== undefined) {
		window.location.href = response.return_url;
	}
}

function formError(error, formResult, submitBtn, loadingBtn) {
	if (formResult) {
		formResult.classList.add('flr-blocks-danger');
		formResult.innerHTML = 'An error occurred. Please try again.';
	}

	if (loadingBtn) {
		loadingBtn.classList.add('flr-blocks-hide');
	}

	if (submitBtn) {
		submitBtn.disabled = false;
	}

	console.error('Form submission error:', error);
}
