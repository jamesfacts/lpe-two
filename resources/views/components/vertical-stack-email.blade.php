<div class="mailpoet_form mailpoet_form_widget mailpoet_form_position_ mailpoet_form_animation_ max-w-lg" id="mailpoet_form_1" >

  <div class="mailpoet_form_popup_overlay"></div>

  <h3 class="text-2xl text-white font-necto uppercase mb-6 max-w-sm" id="newsletter-label">Enter Your Email To Subscribe</h3>

<form target="_self" method="post" action="{{ home_url('/wp-admin/admin-post.php?action=mailpoet_subscription_form') }}" class="border border-white mailpoet_form mailpoet_form_form mailpoet_form_widget" novalidate="" data-delay="" data-exit-intent-enabled="" data-font-family="" style="padding: 0;">
    <input type="hidden" name="data[form_id]" value="1">
    <input type="hidden" name="token" value="a18cea1686">
    <input type="hidden" name="api_version" value="v1">
    <input type="hidden" name="endpoint" value="subscribers">
    <input type="hidden" name="mailpoet_method" value="subscribe">

    <label class="mailpoet_hp_email_label">Please leave this field empty<input type="email" name="data[email]"></label>
    
    <div class="mailpoet_paragraph ">
      <label class="mailpoet_text_label" data-automation-id="form_email_label">Email <span class="mailpoet_required">*</span></label>
      
      <input type="email" class="bg-transparent text-center py-1 uppercase mailpoet_text required email mc-input w-full font-necto text-white" name="data[form_field_YzY4MjhkOGMzYzJjX2VtYWls]" title="Email" value=""  data-automation-id="form_email" data-parsley-required="true" data-parsley-minlength="6" data-parsley-maxlength="150" data-parsley-error-message="Please specify a valid email address." data-parsley-required-message="This field is required."  aria-labelledby="newsletter-label" placeholder="Enter email address" >
    </div>

    <div class="mailpoet_paragraph  last"><input type="submit" class="py-1 cursor-pointer mailpoet_submit bg-white uppercase font-necto w-full" value="Subscribe!" data-automation-id="subscribe-submit-button" ><span class="mailpoet_form_loading"><span class="mailpoet_bounce1"></span><span class="mailpoet_bounce2"></span><span class="mailpoet_bounce3"></span></span></div>

    <div class="mailpoet_message">
      <p class="mailpoet_validate_success" style="display:none;">Check your inbox or spam folder to confirm your subscription.
      </p>
      <p class="mailpoet_validate_error" style="display:none;">        </p>
    </div>
  </form>
</div>
