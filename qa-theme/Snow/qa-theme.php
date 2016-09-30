<?php

class qa_html_theme extends qa_html_theme_base
{
	// use new ranking layout
	protected $ranking_block_layout = true;

	// outputs login form if user not logged in
	public function nav_user_search()
	{
		if (!qa_is_logged_in()) {
			if (isset($this->content['navigation']['user']['login']) && !QA_FINAL_EXTERNAL_USERS) {
				$login = $this->content['navigation']['user']['login'];
				$this->output(
					'<form class="qam-login-form" action="'.$login['url'].'" method="post">',
						'<input type="text" class="qam-login-text" name="emailhandle" dir="auto" placeholder="'.trim(qa_lang_html(qa_opt('allow_login_email_only') ? 'users/email_label' : 'users/email_handle_label'), ':').'"/>',
						'<input type="password" class="qam-login-text" name="password" dir="auto" placeholder="'.trim(qa_lang_html('users/password_label'), ':').'"/>',
						'<div class="qam-rememberbox"><input type="checkbox" name="remember" id="qam-rememberme" value="1"/>',
						'<label for="qam-rememberme" class="qam-remember">'.qa_lang_html('users/remember').'</label></div>',
						'<input type="hidden" name="code" value="'.qa_html(qa_get_form_security_code('login')).'"/>',
						'<input type="submit" value="' . qa_lang_html('users/login_button') . '" class="qa-form-tall-button qa-form-tall-button-login" name="dologin"/>',
					'</form>'
				);

				// remove regular navigation link to log in page
				unset($this->content['navigation']['user']['login']);
			}
		}

		qa_html_theme_base::nav_user_search();
	}

	public function logged_in()
	{
		if (qa_is_logged_in()) // output user avatar to login bar
			$this->output(
				'<div class="qa-logged-in-avatar">',
				QA_FINAL_EXTERNAL_USERS
				? qa_get_external_avatar_html(qa_get_logged_in_userid(), 24, true)
				: qa_get_user_avatar_html(qa_get_logged_in_flags(), qa_get_logged_in_email(), qa_get_logged_in_handle(),
					qa_get_logged_in_user_field('avatarblobid'), qa_get_logged_in_user_field('avatarwidth'), qa_get_logged_in_user_field('avatarheight'),
					24, true),
				'</div>'
			);

		qa_html_theme_base::logged_in();

		if (qa_is_logged_in()) { // adds points count after logged in username
			$userpoints=qa_get_logged_in_points();

			$pointshtml=($userpoints==1)
				? qa_lang_html_sub('main/1_point', '1', '1')
				: qa_lang_html_sub('main/x_points', qa_html(number_format($userpoints)));

			$this->output(
				'<span class="qa-logged-in-points">',
				'('.$pointshtml.')',
				'</span>'
			);
		}
	}

	// adds login bar, user navigation and search at top of page in place of custom header content
	public function body_header()
	{
		$this->output('<div class="qam-login-bar"><div class="qam-login-group">');
		$this->nav_user_search();
		$this->output('</div></div>');
	}

	// allows modification of custom element shown inside header after logo
	public function header_custom()
	{
		if (isset($this->content['body_header'])) {
			$this->output('<div class="header-banner">');
			$this->output_raw($this->content['body_header']);
			$this->output('</div>');
		}
	}

	// removes user navigation and search from header and replaces with custom header content. Also opens new <div>s
	public function header()
	{
		$this->output('<div class="qa-header">');

		$this->logo();
		$this->header_clear();
		$this->header_custom();

		$this->output('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 722.3 206.4" enable-background="new 0 0 722.3 206.4" style="height: 50px; float:right">
                    <pattern x="-61.8" y="672.1" width="69" height="69" patternUnits="userSpaceOnUse" viewBox="2.1 -70.9 69 69" overflow="visible"><polygon fill="none" points="71.1,-1.9 2.1,-1.9 2.1,-70.9 71.1,-70.9"></polygon><polygon fill="#F6BB60" points="71.1,-1.9 2.1,-1.9 2.1,-70.9 71.1,-70.9"></polygon><g fill="#fff"><path d="M61.8-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M54.1-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M46.4-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M38.8-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M31.1-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.4-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M15.8-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M8.1-71.7v.2l-.2.2c-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path><path d="M.4-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.2.4.6.6.7.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path></g><path fill="#fff" d="M69.4-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path fill="#fff" d="M.5-71.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.2.3.6.6.7.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path><g fill="#fff"><path d="M69.4-64v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M61.8-64v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M54.1-64v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M46.5-64v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M38.8-64v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M31.1-64v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.5-64v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M15.8-64v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M8.2-64v.2c-.1.1-.2.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4 0 .2.2.4.3.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2l.1.3"></path><path d="M.5-64v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5.1 0 .3.1.4 0 .2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path><path d="M69.4-56.3v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M61.8-56.3v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M54.1-56.3v.2c-.1 0-.1 0-.2.1s-.1.3-.1.4c-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M46.5-56.3v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M38.8-56.3v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M31.1-56.3v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.5-56.3v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M15.8-56.3v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M8.2-56.3v.2c-.1 0-.2 0-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M.5-56.3v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M69.4-48.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M61.8-48.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M54.1-48.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M46.5-48.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M38.8-48.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M31.1-48.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.5-48.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M15.8-48.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M8.2-48.7v.2c-.1.1-.2.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.1.2.3.6.5.6s.4-.1.5-.1c.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2l.1.3"></path><path d="M.5-48.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.2.3.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M69.4-41v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M61.8-41v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M54.1-41v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M46.5-41v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M38.8-41v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M31.1-41v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.5-41v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M15.8-41v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M8.2-41v.2c-.1 0-.2 0-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M.5-41v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5h.4c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path><path d="M69.4-33.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M61.8-33.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M54.1-33.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M46.5-33.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M38.8-33.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M31.1-33.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.5-33.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M15.8-33.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M8.2-33.4v.2c-.1.1-.2.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M.5-33.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M69.4-25.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M61.8-25.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M54.1-25.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M46.5-25.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M38.8-25.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M31.1-25.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.5-25.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M15.8-25.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M8.2-25.7v.2l-.2.1c-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4 0 .1.2.3.3.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2.1.2.1.2.1.3"></path><path d="M.5-25.7v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.3.5.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M69.4-18.1v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M61.8-18.1v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M54.1-18.1v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M46.5-18.1v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M38.8-18.1v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M31.1-18.1v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.5-18.1v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M15.8-18.1v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M8.2-18.1v.2c-.1.1-.2.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4 0 .2.2.4.3.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2l.1.3c-.1.1-.1 0 0 0"></path><path d="M.5-18.1v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.1"></path><path d="M69.4-10.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M61.8-10.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1l.3-.4.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path><path d="M54.1-10.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M46.5-10.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M38.8-10.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1l.3-.4.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path><path d="M31.1-10.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.5-10.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M15.8-10.4v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1l.3-.4.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path><path d="M8.2-10.4v.2l-.2.1c-.1.1-.1.3-.1.3-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4 0 .2.2.4.3.6.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2.1.2.1.2.1.3"></path><path d="M.5-10.4v.2c-.1.1-.1.1-.2.1 0 .1-.1.3-.1.3-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.2.3.6.6.7.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1l.3-.4.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path></g><g fill="#fff"><path d="M69.4-2.8v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.2.2.4.6.6.7.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path><path d="M61.8-2.8v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4 0 .2.2.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M54.1-2.8v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.2.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2.1.3-.1.4-.3v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.1"></path><path d="M46.5-2.8v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.1.2.3.6.5.7.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2l.1.2"></path><path d="M38.8-2.8v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4 0 .2.2.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M31.1-2.8v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.2.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M23.5-2.8v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.3.4.4.5.1.2.3.6.6.7.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.2"></path><path d="M15.8-2.8v.2c-.1.1-.1.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4.1.2.2.4.4.5.2.1.4.6.6.6.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.2 0-.3.1-.4.2-.2.1-.1.2-.3.2-.1 0-.2.1-.2.2v.3"></path><path d="M8.2-2.8v.2c-.1.1-.2.1-.2.1-.1.1-.1.3-.1.4-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4 0 .2.2.4.3.5.2.2.4.6.6.7.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2-.1.3-.3.4-.5v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8 0 .1-.2.2-.3.2l-.3.3c-.1 0-.2.1-.2.2v.1c-.1.1-.1 0 0 0"></path><path d="M.5-2.8v.2c-.1.1-.1.1-.2.1l-.1.4c-.2.1 0 .2 0 .3v.2c0 .1 0 .3.1.4 0 .2.2.4.4.5.2.2.3.6.6.7.2 0 .4-.1.5-.1.2 0 .4 0 .6-.1.2-.1.1-.3.3-.5l.4-.1c.2 0 .3-.2.4-.4v-.2l.1-.3-.1-.2v-.3c0-.2 0-.4-.1-.5-.4-.7-1.2-.9-2-.8-.1 0-.2.1-.4.1-.1.1-.1.2-.3.3-.1 0-.2.1-.2.2v.1"></path></g></pattern><path d="M619.1 0c-57 0-103.2 46.2-103.2 103.2s46.2 103.2 103.2 103.2 103.2-46.2 103.2-103.2-46.2-103.2-103.2-103.2zm52.8 82.9c0 7.2-5.8 13-12.9 13-7.1 0-13-5.8-13-13 0-7.1 5.8-12.9 13-12.9 7.1 0 12.9 5.8 12.9 12.9zm-55.4-12.3c4-2.3 7.3-5.9 9-10.6 1.7-4.7 1.5-9.5-.1-13.9l-.8-2.2c-.9-2.7-.9-5.8.1-8.6 2.4-6.7 9.9-10.2 16.6-7.7 6.7 2.5 10.2 9.9 7.7 16.6-1.1 2.9-3 5.2-5.5 6.7l-2.1 1.2c-4.1 2.2-7.3 5.9-9 10.6-1.7 4.6-1.5 9.5.1 13.9l.8 2.2c.9 2.7 1 5.7-.1 8.7-2.5 6.7-9.9 10.1-16.6 7.7-6.7-2.5-10.2-9.9-7.7-16.6 1-2.9 3-5.2 5.5-6.7l2.1-1.3zm-45.2 7.9c1-2.9 3-5.2 5.5-6.7l2.1-1.2c4-2.3 7.3-5.9 9-10.6 1.7-4.7 1.5-9.5-.1-13.9l-.8-2.1c-.9-2.7-.9-5.8.1-8.6 2.4-6.7 9.9-10.2 16.6-7.7 6.7 2.5 10.2 9.9 7.7 16.6-1.1 2.9-3 5.2-5.5 6.7l-2.1 1.2c-4.1 2.2-7.3 5.9-9 10.6-1.7 4.6-1.5 9.5.1 13.9l.8 2.2c1 2.7 1 5.7-.1 8.7-2.5 6.7-9.9 10.1-16.6 7.7-6.7-2.7-10.2-10.1-7.7-16.8zm-.8 44.6c0-7.2 5.8-13 12.9-13 7.1 0 13 5.8 13 13 0 7.1-5.8 12.9-13 12.9-7.1 0-12.9-5.8-12.9-12.9zm55.3 12.2c-4 2.3-7.3 5.9-9 10.6-1.7 4.7-1.5 9.5.1 13.9l.8 2.2c.9 2.7.9 5.8-.1 8.6-2.4 6.7-9.9 10.2-16.6 7.7-6.7-2.5-10.2-9.9-7.7-16.6 1.1-2.9 3-5.2 5.5-6.6l2.1-1.2c4.1-2.2 7.3-5.9 9-10.6 1.7-4.6 1.5-9.5-.1-13.9l-.8-2.2c-.9-2.7-1-5.7.1-8.7 2.5-6.7 9.9-10.1 16.6-7.7 6.7 2.5 10.2 9.9 7.7 16.6-1 2.9-3 5.2-5.5 6.7l-2.1 1.2zm45.4-7.8c-1 2.9-3 5.2-5.5 6.7l-2.1 1.2c-4 2.3-7.3 5.9-9 10.6-1.7 4.7-1.5 9.5.1 13.9l.8 2.2c.9 2.7.9 5.8-.1 8.6-2.4 6.7-9.9 10.2-16.6 7.7-6.7-2.5-10.2-9.9-7.7-16.6 1.1-2.9 3-5.2 5.5-6.6l2.1-1.2c4.1-2.2 7.3-5.9 9-10.6 1.7-4.6 1.5-9.5-.1-13.9l-.8-2.2c-.9-2.7-1-5.7.1-8.7 2.5-6.7 9.9-10.1 16.6-7.7 6.7 2.5 10.1 9.9 7.7 16.6z"></path><polygon points="0,8.1 29.7,8.1 47.6,67.6 47.9,67.6 65.6,8.1 95.3,8.1 95.3,98.5 74.1,98.5 74.8,39.5 74.6,39.3 55.3,98.5 40,98.5 20.7,39.3 20.5,39.5 21.2,98.5 0,98.5"></polygon><polygon points="194.2,8.1 217.3,8.1 217.3,48.8 217.5,48.8 243,8.1 267.2,8.1 237.3,53.2 269.2,98.5 242.2,98.5 217.5,59.4 217.3,59.4 217.3,98.5 194.2,98.5"></polygon><rect x="270.8" y="8.1" width="23.1" height="90.3"></rect><polygon points="302.9,8.1 322.8,8.1 357.7,63.4 357.9,63.2 356.9,8.1 379,8.1 379,98.5 359,98.5 324.6,45 324.4,45.1 325,98.5 302.9,98.5"></polygon><path d="M479.7 46.8c.1 1.6.1 2.9.1 4.7 0 30-23 48.1-47.9 48.1-27.1 0-47.6-21.2-47.6-47 0-26.8 21.6-46.2 48-46.2 21.4 0 39.9 14.4 44.8 31.7h-25.7c-3.5-6.3-10-11.6-19.7-11.6-11.3 0-24.5 8.4-24.5 26 0 18.8 13.3 26.9 24.6 26.9 11.4 0 19-5.7 21.4-14.4h-26.8v-18.2h53.3zM129 85.4l-4.8 13.1h-24.7l32-90.3h26.6l31.7 90.3h-25l-4.4-13.1h-31.4zm6.4-18.3h18.9l-9.3-37.2h-.4l-9.2 37.2z"></path><polygon points="185.8,108 168,161.9 155.5,108 134.3,108 121.6,161.6 104.4,108 81,108 110.3,198.3 131.2,198.3 144.7,142.1 145,142.1 158.5,198.3 178.8,198.3 209.1,108"></polygon><path d="M220.7 185.2l-4.8 13.1h-24.8l32-90.3h26.6l31.7 90.3h-25l-4.4-13.1h-31.3zm6.4-18.3h18.9l-9.3-37.2h-.4l-9.2 37.2z"></path><polygon points="288.5,108 306.6,170.4 306.9,170.4 325.2,108 349,108 318.7,198.3 294.9,198.3 264.8,108"></polygon><polygon points="353.1,108 407.4,108 407.4,128.2 375.2,128.2 375.2,142.2 404,142.2 404,162.5 375.2,162.5 375.2,178 407.4,178 407.4,198.3 353.1,198.3"></polygon><path d="M452.4 134.8c-.5-3-1.2-8.7-8.2-8.7-4 0-7.9 2.8-7.9 7 0 5.3 2.4 6.4 18.6 13.7 16.7 7.5 21 15.3 21 25.7 0 13.1-7.5 27.5-31.3 27.5-26 0-32.4-17-32.4-28.5v-2.9h22.8c0 10.4 6.4 12.3 9.3 12.3 5.5 0 8.8-4.5 8.8-8.6 0-5.9-3.8-7.4-17.6-13.2-6.3-2.5-21.9-8.9-21.9-25.7 0-16.8 16.4-26.4 31.4-26.4 8.8 0 18.4 3.3 24.3 10.2 5.3 6.5 5.7 12.6 5.9 17.7h-22.8z"></path>
                </svg>');
		$this->output('</div> <!-- END qa-header -->', '');

		$this->output('<div class="qa-main-shadow">', '');
		$this->output('<div class="qa-main-wrapper">', '');
		$this->nav_main_sub();

	}

	// removes sidebar for user profile pages
	public function sidepanel()
	{
		if ($this->template!='user')
			qa_html_theme_base::sidepanel();
	}

	// prevent display of regular footer content (see body_suffix()) and replace with closing new <div>s
	public function footer()
	{
		$this->output('</div> <!-- END main-wrapper -->');
		$this->output('</div> <!-- END main-shadow -->');
	}

	// add RSS feed icon after the page title
	public function title()
	{
		qa_html_theme_base::title();

		$feed=@$this->content['feed'];

		if (!empty($feed))
			$this->output('<a href="'.$feed['url'].'" title="'.@$feed['label'].'"><img src="'.$this->rooturl.'images/rss.jpg" alt="" width="16" height="16" border="0" class="qa-rss-icon"/></a>');
	}

	// add view count to question list
	public function q_item_stats($q_item)
	{
		$this->output('<div class="qa-q-item-stats">');

		$this->voting($q_item);
		$this->a_count($q_item);
		qa_html_theme_base::view_count($q_item);

		$this->output('</div>');
	}

	// prevent display of view count in the usual place
	public function view_count($q_item)
	{
		if ($this->template=='question')
			qa_html_theme_base::view_count($q_item);
	}

	// to replace standard Q2A footer
	public function body_suffix()
	{
		$this->output('<div class="qa-footer-bottom-group">');
		qa_html_theme_base::footer();
		$this->output('</div> <!-- END footer-bottom-group -->', '');
	}

	public function attribution()
	{
		$this->output(
			'<div class="qa-attribution">',
			'&nbsp;| Snow Theme by <a href="http://www.q2amarket.com">Q2A Market</a>',
			'</div>'
		);

		qa_html_theme_base::attribution();
	}
}
