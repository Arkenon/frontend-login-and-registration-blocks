jQuery(document).ready(function ($) {
	$('#flwgb-login-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flwgb-login-form')
		);
		const submitBtn = form.find('#flwgb-login-submit');
		const formResult = $('#flwgb-login-form-result');
		const loadingBtn = $('#flwgb-login-loading');

		$.ajax({
			url: flwgb_ajax_object.ajax_url,
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
	$('#flwgb-reset-pass-request-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flwgb-reset-pass-request-form')
		);
		const submitBtn = form.find('#flwgb-reset-request-submit');
		const formResult = $('#flwgb-reset-request-form-result');
		const loadingBtn = $('#flwgb-reset-request-loading');

		$.ajax({
			url: flwgb_ajax_object.ajax_url,
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
	$('#flwgb-reset-pass-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flwgb-reset-pass-form')
		);
		const submitBtn = form.find('#flwgb-reset-password-submit');
		const formResult = $('#flwgb-reset-password-form-result');
		const loadingBtn = $('#flwgb-reset-password-loading');

		$.ajax({
			url: flwgb_ajax_object.ajax_url,
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
	$('#flwgb-register-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flwgb-register-form')
		);
		const submitBtn = form.find('#flwgb-register-submit');
		const formResult = $('#flwgb-register-form-result');
		const loadingBtn = $('#flwgb-register-loading');

		$.ajax({
			url: flwgb_ajax_object.ajax_url,
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
	$('#flwgb-user-settings-form').on('submit', function (e) {
		e.preventDefault();
		const form = $(this);
		const formData = new FormData(
			document.getElementById('flwgb-user-settings-form')
		);
		const submitBtn = form.find('#flwgb-user-settings-submit');
		const formResult = $('#flwgb-user-settings-form-result');
		const loadingBtn = $('#flwgb-user-settings-loading');

		$.ajax({
			url: flwgb_ajax_object.ajax_url,
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
		loadingBtn.removeClass('flwgb-hide');
		form_result.html('');
		submitBtn.prop('disabled', true);
	}

	function formSuccess(response, form_result, submitBtn, loadingBtn) {
		if (response.status) {
			form_result.addClass('flwgb-success');
		} else {
			form_result.addClass('flwgb-danger');
		}

		form_result.html(response.message);

		loadingBtn.addClass('flwgb-hide');

		submitBtn.prop('disabled', false);

		if (response.return_url != null) {
			window.location.href = response.return_url;
		}
	}

	function formError(xhr, form_result){
		form_result.addClass('flwgb-danger');
		form_result.html(xhr.responseText);
	}

});


