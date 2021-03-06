<!DOCTYPE html> <html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<meta name='viewport' content='width=device-width' />
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
</head>
<body>
	<table class='body-wrap'>
		<style media='screen'>
		* {
			margin: 0;
			padding: 0;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			box-sizing: border-box;
			font-size: 14px;
		}
		img {
			max-width: 100%;
		}
		body {
			-webkit-font-smoothing: antialiased;
			-webkit-text-size-adjust: none;
			width: 100% !important;
			height: 100%;
			line-height: 1.6;
		}
		table td {
			vertical-align: top;
		}
		body {
			background-color: #f6f6f6;
		}
		.body-wrap {
			background-color: #f6f6f6;
			width: 100%;
		}
		.container {
			display: block !important;
			max-width: 600px !important;
			margin: 0 auto !important;
			/* makes it centered */
			clear: both !important;
		}
		.content {
			max-width: 600px;
			margin: 0 auto;
			display: block;
			padding: 20px;
		}
		.main {
			background: #fff;
			border: 1px solid #e9e9e9;
			border-radius: 3px;
		}
		.content-wrap {
			padding: 20px;
		}
		.content-block {
			padding: 0 0 20px;
		}
		.header {
			width: 100%;
			margin-bottom: 20px;
		}
		.footer {
			width: 100%;
			clear: both;
			color: #999;
			padding: 20px;
		}
		.footer a {
			color: #999;
		}
		.footer p, .footer a, .footer unsubscribe, .footer td {
			font-size: 12px;
		}

		h1, h2, h3 {
			font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;
			color: #000;
			margin: 40px 0 0;
			line-height: 1.2;
			font-weight: 400;
		}

		h1 {
			font-size: 32px;
			font-weight: 500;
		}

		h2 {
			font-size: 24px;
		}

		h3 {
			font-size: 18px;
		}

		h4 {
			font-size: 14px;
			font-weight: 600;
		}

		p, ul, ol {
			margin-bottom: 10px;
			font-weight: normal;
		}
		p li, ul li, ol li {
			margin-left: 5px;
			list-style-position: inside;
		}

		a {
			color: #1ab394;
			text-decoration: underline;
		}

		.btn-primary {
			text-decoration: none;
			color: #FFF;
			background-color: #1ab394;
			border: solid #1ab394;
			border-width: 5px 10px;
			line-height: 2;
			font-weight: bold;
			text-align: center;
			cursor: pointer;
			display: inline-block;
			border-radius: 5px;
			text-transform: capitalize;
		}

		.last {
			margin-bottom: 0;
		}

		.first {
			margin-top: 0;
		}

		.aligncenter {
			text-align: center;
		}

		.alignright {
			text-align: right;
		}

		.alignleft {
			text-align: left;
		}

		.clear {
			clear: both;
		}

		.alert {
			font-size: 16px;
			color: #fff;
			font-weight: 500;
			padding: 20px;
			text-align: center;
			border-radius: 3px 3px 0 0;
		}
		.alert a {
			color: #fff;
			text-decoration: none;
			font-weight: 500;
			font-size: 16px;
		}
		.alert.alert-warning {
			background: #f8ac59;
		}
		.alert.alert-bad {
			background: #ed5565;
		}
		.alert.alert-good {
			background: #1ab394;
		}

		.invoice {
			margin: 40px auto;
			text-align: left;
			width: 80%;
		}
		.invoice td {
			padding: 5px 0;
		}
		.invoice .invoice-items {
			width: 100%;
		}
		.invoice .invoice-items td {
			border-top: #eee 1px solid;
		}
		.invoice .invoice-items .total td {
			border-top: 2px solid #333;
			border-bottom: 2px solid #333;
			font-weight: 700;
		}

		@media only screen and (max-width: 640px) {
			h1, h2, h3, h4 {
				font-weight: 600 !important;
				margin: 20px 0 5px !important;
			}

			h1 {
				font-size: 22px !important;
			}

			h2 {
				font-size: 18px !important;
			}

			h3 {
				font-size: 16px !important;
			}

			.container {
				width: 100% !important;
			}

			.content, .content-wrap {
				padding: 10px !important;
			}

			.invoice {
				width: 100% !important;
			}
		}
		</style>
		<tr>
			<td class='container' width='600'>
				<div class='content'>
					<table class='main' width='100%' cellpadding='0' cellspacing='0'>
						<tr>
							<td class='content-wrap'>
								<table  cellpadding='0' cellspacing='0'>
									<tr>
										<td class='content-block'>
											<h3>Dear $customer_name.</h3>
										</td>
									</tr>
									<tr>
										<td class='content-block'>
											<p style='Margin-top: 0;Margin-bottom: 20px;'>We have attached your quotation on this email and we look forward to hearing from you soon. Please note that the prices and availability are subject to change.</p>
											<p style='Margin-top: 0;Margin-bottom: 20px;'>Should you have question, do get in touch with us using the details beolow or by replying to this email.</p>
										</td>

									</tr>
								</table>

							</td>
						</tr>
					</table>
					<div class='footer'>
						<table width='100%'>
							<tr>
								<td><div class='column js-footer-additional-info' style='text-align: right;font-size: 12px;line-height: 19px;color: #999;font-family: sans-serif;width: 526px;' dir='ltr'>
									<div style='margin-left: 0;margin-right: 0;Margin-top: 10px;Margin-bottom: 10px;'>
										<div class='email-footer__additional-info' style='font-size: 12px;line-height: 19px;margin-bottom: 3px;margin-top: 0px;'>
											<div bind-to='address'>
												<p class='email-flexible-footer__additionalinfo--center' style='Margin-top: 0;Margin-bottom: 0;'>Enfield Zimbabwe Pvt. Ltd.</p>
											</div>
										</div>
										<div class='email-footer__additional-info' style='font-size: 12px;line-height: 19px;margin-bottom: 3px;margin-top: 0px;'>
											<div>
												<p class='email-flexible-footer__additionalinfo--center' style='Margin-top: 0;Margin-bottom: 0;'>Corner Hobbs & Plymouth</p>
											</div>
										</div>
										<div class='email-footer__additional-info' style='font-size: 12px;line-height: 19px;margin-bottom: 3px;'>
											<div bind-to='permission'>
												<p class='email-flexible-footer__additionalinfo--center' style='Margin-top: 0;Margin-bottom: 0;'></p>
											</div>
										</div>
										<div class='email-footer__additional-info' style='font-size: 12px;line-height: 19px;margin-bottom: 15px;'>
											<span>
												<preferences style='text-decoration: underline;' lang='en'> +263 8644 058 116 </preferences>&nbsp;&nbsp;|&nbsp;&nbsp;
											</span>
											<unsubscribe style='text-decoration: underline;'><a href='mailto:sales@enfield.co.zw'>sales@enfield.co.zw</a> </unsubscribe>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>

				</div></div>
			</td>
			<td></td>
		</tr>
	</table>
</body>
</html>
