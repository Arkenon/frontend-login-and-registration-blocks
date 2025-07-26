function formBeforeSend(formResult, submitBtn, loadingBtn) {
	if (loadingBtn) {
		loadingBtn.classList.remove('flr-blocks-hide');
	}
	if (formResult) {
		formResult.innerHTML = '';
		formResult.classList.remove(
			'flr-blocks-success',
			'flr-blocks-danger'
		);
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

export { formBeforeSend, formSuccess, formError };
