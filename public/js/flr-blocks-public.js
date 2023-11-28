jQuery(document).ready(function ($) {
	$('#flr-blocks-login-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flr-blocks-login-form')
		);
		const submitBtn = form.find('#flr-blocks-login-submit');
		const formResult = $('#flr-blocks-login-form-result');
		const loadingBtn = $('#flr-blocks-login-loading');

		$.ajax({
			url: flr_blocks_ajax_object.ajax_url,
			type: 'POST',
			processData: false,
			contentType: false,
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				formBeforeSend(formResult, submitBtn, loadingBtn)
			},
			success: function (response) {
				formSuccess(response, formResult, submitBtn, loadingBtn)
			},
			error: function (xhr) {
				formError(xhr, formResult)
			},
		});
	});

	//Lost password request form
	$('#flr-blocks-reset-pass-request-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flr-blocks-reset-pass-request-form')
		);
		const submitBtn = form.find('#flr-blocks-reset-request-submit');
		const formResult = $('#flr-blocks-reset-request-form-result');
		const loadingBtn = $('#flr-blocks-reset-request-loading');

		$.ajax({
			url: flr_blocks_ajax_object.ajax_url,
			type: 'POST',
			processData: false,
			contentType: false,
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				formBeforeSend(formResult, submitBtn, loadingBtn)
			},
			success: function (response) {
				formSuccess(response, formResult, submitBtn, loadingBtn)
			},
			error: function (xhr) {
				formError(xhr, formResult)
			},
		});
	});

	// Reset Password Form
	$('#flr-blocks-reset-pass-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flr-blocks-reset-pass-form')
		);
		const submitBtn = form.find('#flr-blocks-reset-password-submit');
		const formResult = $('#flr-blocks-reset-password-form-result');
		const loadingBtn = $('#flr-blocks-reset-password-loading');

		$.ajax({
			url: flr_blocks_ajax_object.ajax_url,
			type: 'POST',
			processData: false,
			contentType: false,
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				formBeforeSend(formResult, submitBtn, loadingBtn)
			},
			success: function (response) {
				formSuccess(response, formResult, submitBtn, loadingBtn)
			},
			error: function (xhr) {
				formError(xhr, formResult)
			},
		});
	});

	// Registration Form
	$('#flr-blocks-register-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flr-blocks-register-form')
		);
		const submitBtn = form.find('#flr-blocks-register-submit');
		const formResult = $('#flr-blocks-register-form-result');
		const loadingBtn = $('#flr-blocks-register-loading');

		$.ajax({
			url: flr_blocks_ajax_object.ajax_url,
			type: 'POST',
			processData: false,
			contentType: false,
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				formBeforeSend(formResult, submitBtn, loadingBtn)
			},
			success: function (response) {
				formSuccess(response, formResult, submitBtn, loadingBtn)
			},
			error: function (xhr) {
				formError(xhr, formResult)
			},
		});
	});

	// User Settings Form
	$('#flr-blocks-user-settings-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flr-blocks-user-settings-form')
		);
		const submitBtn = form.find('#flr-blocks-user-settings-submit');
		const formResult = $('#flr-blocks-user-settings-form-result');
		const loadingBtn = $('#flr-blocks-user-settings-loading');

		$.ajax({
			url: flr_blocks_ajax_object.ajax_url,
			type: 'POST',
			processData: false,
			contentType: false,
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				formBeforeSend(formResult, submitBtn, loadingBtn)
			},
			success: function (response) {
				formSuccess(response, formResult, submitBtn, loadingBtn)
			},
			error: function (xhr) {
				formError(xhr, formResult)
			},
		});
	});

	function formBeforeSend(form_result, submitBtn, loadingBtn) {
		loadingBtn.removeClass('flr-blocks-hide');
		form_result.html('');
		submitBtn.prop('disabled', true);
	}

	function formSuccess(response, form_result, submitBtn, loadingBtn) {
		if (response.status) {
			form_result.addClass('flr-blocks-success');
		} else {
			form_result.addClass('flr-blocks-danger');
		}

		form_result.html(response.message);

		loadingBtn.addClass('flr-blocks-hide');

		submitBtn.prop('disabled', false);

		if (response.return_url != null) {
			window.location.href = response.return_url;
		}
	}

	function formError(xhr, form_result){
		form_result.addClass('flr-blocks-danger');
		form_result.html(xhr.responseText);
	}

});


