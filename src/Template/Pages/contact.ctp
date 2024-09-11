<link rel='stylesheet' href='<?= WEBROOT ?>css/contact-form-style.css' type='text/css' media='screen' />

<div class="headline cmsms_color_scheme_default">
    <div class="headline_outer">
        <div class="headline_color"></div>
        <div class="headline_inner align_left">
            <div class="headline_aligner"></div><div class="headline_text"><h1 class="entry-title">Contact Us</h1></div>
        </div>
    </div>
</div>
<br />
<br />

<div id="cmsms_row_555091c556fa4" class="cmsms_row cmsms_color_scheme_default">
    <div class="cmsms_row_outer_parent">
        <div class="cmsms_row_outer">
            <div class="cmsms_row_inner">
                <div class="cmsms_row_margin">
                    <div class="cmsms_column one_half">
                        <h3 id="cmsms_heading_555091c557200" class="cmsms_heading">Send Message</h3>
                        <div class="cmsms_contact_form">
                            <div class="cmsms-form-builder">
                                <div class="cmsms_notice cmsms_notice_success cmsms-icon-check-2 success_box widgetinfo" style="display:none;">
                                    <div class="notice_icon"></div>
                                    <div class="notice_content">
                                        <p>Thank You! <br />Your message has been sent successfully.</p>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    jQuery(document).ready(function () {
                                        jQuery('#contactform').validationEngine('init');

                                        jQuery('#contactform a#contact_form_formsend').click(function () {
                                            var form_builder_url = jQuery('#contact_form_url').val();

                                            jQuery('#contactform .loading').animate({opacity: 1}, 250);

                                            if (jQuery('#contactform').validationEngine('validate')) {
                                                jQuery.post(form_builder_url, {
                                                    contact_name: jQuery('#contact_name').val(),
                                                    contact_email: jQuery('#contact_email').val(),
                                                    contact_url: jQuery('#contact_url').val(),
                                                    contact_subject: jQuery('#contact_subject').val(),
                                                    contact_message: jQuery('#contact_message').val(),
                                                    formname: 'contact_form',
                                                    formtype: 'contactfmain'
                                                }, function () {
                                                    jQuery('#contactform .loading').animate({opacity: 0}, 250);

                                                    document.getElementById('contactform').reset();

                                                    jQuery('#contactform').parent().find('.box').hide();
                                                    jQuery('#contactform').parent().find('.success_box').fadeIn('fast');
                                                    jQuery('html, body').animate({scrollTop: jQuery('#contactform').offset().top - 100}, 'slow');
                                                    jQuery('#contactform').parent().find('.success_box').delay(5000).fadeOut(1000);
                                                });

                                                return false;
                                            } else {
                                                jQuery('#contactform .loading').animate({opacity: 0}, 250);

                                                return false;
                                            }
                                        });
                                    });
                                </script>
                                <form action="#" method="post" id="contactform">
                                    <div class="form_info cmsms_input one_half">
                                        <label for="contact_name">Name <span class="color_3">*</span></label>
                                        <div class="form_field_wrap">
                                            <input type="text" name="contact_name" id="contact_name" value="" size="22" tabindex="3" class="validate[required,minSize[3],maxSize[100],custom[onlyLetterSp]]"/>
                                        </div>
                                    </div>
                                    <div class="form_info cmsms_input one_half">
                                        <label for="contact_email">Email <span class="color_3">*</span></label>
                                        <div class="form_field_wrap">
                                            <input type="text" name="contact_email" id="contact_email" value="" size="22" tabindex="4" class="validate[required,custom[email]]" />
                                        </div>
                                    </div>
                                    <div class="form_info cmsms_input one_half">
                                        <label for="contact_url">Website</label>
                                        <div class="form_field_wrap">
                                            <input type="text" name="contact_url" id="contact_url" value="" size="22" tabindex="5" class="validate[custom[url]]" />
                                        </div>
                                    </div>
                                    <div class="form_info cmsms_input one_half">
                                        <label for="contact_subject">Subject <span class="color_3">*</span></label>
                                        <div class="form_field_wrap">
                                            <input type="text" name="contact_subject" id="contact_subject" value="" size="22" tabindex="6" class="validate[required,minSize[3],maxSize[100]]" />
                                        </div>
                                    </div>
                                    <div class="form_info cmsms_textarea one_first">
                                        <label for="contact_message">Message <span class="color_3">*</span></label>
                                        <div class="form_field_wrap">
                                            <textarea name="contact_message" id="contact_message" cols="28" rows="6" tabindex="7" class="validate[required,minSize[3]]" ></textarea>
                                        </div>
                                    </div>
                                    <div class="cl"></div>
                                    <div><input type="hidden" name="contact_form_url" id="contact_form_url" value="<?= WEBROOT ?>contact" /></div><!-- Here you need to set the path to the sendmail file -->
                                    <div class="form_info submit_wrap">
                                        <a href="#" class="cmsms_button" id="contact_form_formsend" tabindex="8"><span>Send message</span></a>
                                        <div class="loading"></div>
                                    </div>
                                    <div class="cl"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="cmsms_column one_half">
                        <h3 id="cmsms_heading_555091c5584b3" class="cmsms_heading">Some Info</h3>
                        <div class="cmsms_text">
                            <p>Need Help or  Information?<br>
                                Our customer  service team will respond to your email in the shortest possible time upon receival.  We are here to help with any question or concerns you may have regarding the  services we offer or how we can make technology work for your business. Please  feel free to send us an email or contact our Customer Support team at the  numbers listed below. We have experienced IT experts ready to resolve your  issues or point you in the right direction. </p>
                        </div>
                        <ul id="cmsms_icon_list_items_555091c558691" class="cmsms_icon_list_items cmsms_icon_list_type_list cmsms_icon_list_pos_left cmsms_color_type_border">
                            <li id="cmsms_icon_list_item_555091c5587e4" class="cmsms_icon_list_item cmsms-icon-location-7"> Kingston, Jamaica </li>
                            <li id="cmsms_icon_list_item_555091c558872" class="cmsms_icon_list_item cmsms-icon-mobile-6">876-482-6544</li>
                            <!--li id="cmsms_icon_list_item_555091c5588fb" class="cmsms_icon_list_item cmsms-icon-mail-7">example@econature.com</li-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= WEBROOT ?>js/jquery.validationEngine-lang.js" type="text/javascript"></script>
<script src="<?= WEBROOT ?>js/jquery.validationEngine.js" type="text/javascript"></script>


