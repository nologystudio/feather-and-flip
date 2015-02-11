<?php

/**
 * @file
 * Default template for HTML Mail
 *
 * DO NOT EDIT THIS FILE. Copy it to your theme directory, and edit the copy.
 *
 * ========================================================= Begin instructions.
 *
 * When formatting an email message with a given $module and $key, [1]HTML
 * Mail will use the first template file it finds from the following list:
 *  1. htmlmail--$module--$key.tpl.php
 *  2. htmlmail--$module.tpl.php
 *  3. htmlmail.tpl.php
 *
 * For each filename, [2]HTML Mail looks first in the chosen Email theme
 * directory, then in its own module directory, before proceeding to the
 * next filename.
 *
 * For example, if example_module sends mail with:
 * drupal_mail("example_module", "outgoing_message" ...)
 *
 *
 * the possible template file names would be:
 *  1. htmlmail--example_module--outgoing_message.tpl.php
 *  2. htmlmail--example_module.tpl.php
 *  3. htmlmail.tpl.php
 *
 * Template files are cached, so remember to clear the cache by visiting
 * admin/config/development/performance after changing any .tpl.php files.
 *
 * The following variables available in this template:
 *
 * $body
 *        The message body text.
 *
 * $module
 *        The first argument to [3]drupal_mail(), which is, by convention,
 *        the machine-readable name of the sending module.
 *
 * $key
 *        The second argument to [4]drupal_mail(), which should give some
 *        indication of why this email is being sent.
 *
 * $message_id
 *        The email message id, which should be equal to
 *        "{$module}_{$key}".
 *
 * $headers
 *        An array of email (name => value) pairs.
 *
 * $from
 *        The configured sender address.
 *
 * $to
 *        The recipient email address.
 *
 * $subject
 *        The message subject line.
 *
 * $body
 *        The formatted message body.
 *
 * $language
 *        The language object for this message.
 *
 * $params
 *        Any module-specific parameters.
 *
 * $template_name
 *        The basename of the active template.
 *
 * $template_path
 *        The relative path to the template directory.
 *
 * $template_url
 *        The absolute URL to the template directory.
 *
 * $theme
 *        The name of the Email theme used to hold template files. If the
 *        [5]Echo module is enabled this theme will also be used to
 *        transform the message body into a fully-themed webpage.
 *
 * $theme_path
 *        The relative path to the selected Email theme directory.
 *
 * $theme_url
 *        The absolute URL to the selected Email theme directory.
 *
 * $debug
 *        TRUE to add some useful debugging info to the bottom of the
 *        message.
 *
 * Other modules may also add or modify theme variables by implementing a
 * MODULENAME_preprocess_htmlmail(&$variables) [6]hook function.
 *
 * References
 *
 * 1. http://drupal.org/project/htmlmail
 * 2. http://drupal.org/project/htmlmail
 * 3. http://api.drupal.org/api/drupal/includes--mail.inc/function/drupal_mail/7
 * 4. http://api.drupal.org/api/drupal/includes--mail.inc/function/drupal_mail/7
 * 5. http://drupal.org/project/echo
 * 6. http://api.drupal.org/api/drupal/modules--system--theme.api.php/function/hook_preprocess_HOOK/7
 *
 * =========================================================== End instructions.
 */ ?>

<?php if ($params['subject'] == 'F+F New reservation'): // Admin notification ?>
  <?php print_r($params['message']); ?>
<?php elseif ($params['subject'] == 'F+F Contact'): // Admin contact notification ?>
  <?php print_r($params['message']); ?>
<?php else: // Booking notification to customer ?>
  <?php
    $entity = entity_load('entityform', array($params['message']));
    if (!empty($entity)){
      $wrapper = entity_metadata_wrapper('entityform', $entity[$params['message']]);
      $service = $wrapper->field_service->value();
      switch ($service) {
        case 'expedia': ?>
          <div style="background-color:#d9dfdE; font-family: Arial,sans-serif; font-size:14px; line-height: 22px; color: #333333;">
          <table style="width:640px; margin:auto; padding:0; border-collapse:collapse;">
            <tr style="height:20px;"></tr>
            <tr align="center" style="border-bottom: dotted 1px #333333;">
              <td valign="top" style="padding-bottom: 30px;">
                <img style="width:300px; margin: auto;" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sites/all/themes/feflip/media/brand/feather-and-flip-black-logo.png"/>
              </td>
            </tr>
            <tr style="height:20px;"></tr>
            <tr style="border-bottom: dotted 1px #333333;">
              <td style="text-transform: uppercase; font-size: 14px; color: #333333; line-height: 22px; padding-bottom: 20px;">Thank you for booking with Feather+Flip and the Expedia Affiliate Network. We only recommend hotels we know and love, and we hope you feel the same way. Read on for your confirmation number, hotel cancellation policy and contact details.</td>
            </tr>
            <tr style="height:30px;"></tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td valign="top" style="padding-bottom: 20px;">
                    <img style="margin: auto;" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sites/all/themes/feflip/media/services/expedia-service-email.png"/>
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:14px; line-height: 22px; border-bottom: dotted 1px #333333; padding-bottom: 15px">The booking you recently made on the featherandflip.com website is confirmed. Your reservation details are below.</td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:18px; line-height: 22px; padding-top: 15px"><span style="font-weight: bold; margin-right: 10px;">Customer Name:</span> <?php echo $wrapper->field_first_name->value().' '.$wrapper->field_last_name->value(); ?></td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:18px; line-height: 22px;"><span style="font-weight: bold; margin-right: 10px;">Customer Email:</span> <?php echo $wrapper->field_email->value(); ?></td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:18px; line-height: 22px; border-bottom: dotted 1px #333333; padding-bottom: 15px"><span style="font-weight: bold; margin-right: 10px;">Itinerary Number:</span> <?php echo $wrapper->field_booking_id->value(); ?></td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:12px; line-height: 18px; padding-top: 15px">Please refer to your Itinerary Number if you contact customer service for any reason.</td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:12px; line-height: 18px; padding-top: 15px"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/booking-info/<?php echo $wrapper->field_booking_id->value(); ?>" style="color:#7b8c88; text-decoration: none;">View your booking in your Feather+Flip account</a></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px"><?php echo $wrapper->field_hotel_name->value(); ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top: 15px; border-bottom: dotted 1px #333333; padding-bottom: 15px">
                      <table style="margin: 0; padding-top: 15px;border-collapse:collapse; color:#333333; font-size:14px; line-height: 22px;">
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Address:</span><?php echo $wrapper->field_hotel_contact->value(); ?></td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Phone:</span>Phone</td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Fax:</span>Fax</td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Check-in:</span><?php echo $wrapper->field_check_in->value(); ?></td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Check-out:</span><?php echo $wrapper->field_check_out->value(); ?></td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Number of nights:</span><?php echo count(explode('|', $wrapper->field_nights->value())); ?></td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Number of guests:</span><?php echo $wrapper->field_adults->value()+$wrapper->field_children->value(); ?></td></tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px">room details</td>
                  </tr>
                  <tr>
                    <td>
                      <table style="width:100%; margin: 0; padding-top: 15px;border-collapse:collapse; color:#333333; font-size:14px; line-height: 22px;">
                        <tr style="font-weight: bold; padding-top: 30px; padding-bottom: 15px; border-bottom: dotted 1px #333333; ">
                          <td width="10%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">#</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">Room Type</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">Reserved for</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">Confirmation number</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">Refundable</td>
                        </tr>
                        <tr style="padding-top: 15px; padding-bottom: 15px; border-bottom: dotted 1px #333333;">
                          <td width="10%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">#</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;"><?php echo $wrapper->field_room_type->value(); ?></td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;"><?php echo $wrapper->field_first_name->value().' '.$wrapper->field_last_name->value(); ?></td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;"><?php echo $wrapper->field_confirmation_number->value(); ?></td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;"> NO </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:12px; padding-top: 15px;">*Please note: Preferences and special requests cannot be guaranteed. Special requests are subject to availability upon check-in and may incur additional charges.</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
  	            <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
        					<tr>
        						<td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px">charges</td>
        					</tr>
        					<tr>
        						<td style="padding-top:15px;">
        							<span style="font-weight:bold; text-transform: uppercase;">Cost per night and per room in USD$</span> (Excluding tax recovery charges and service fees)
        						</td>
        					</tr>
        					<tr>
        						<td>
        							<table style="width:100%; font-size:14px; line-height: 22px; border-bottom: dotted 1px #333333;">
        								<tr style="border-bottom: dotted 1px #333333; font-weight:bold; line-height: 40px;">
        									<td style="border-bottom: dotted 1px #333333;">Dates</td>
        									<td style="border-bottom: dotted 1px #333333;">Room 1</td>
        									<td width="40%" align="right" style="border-bottom: dotted 1px #333333;">Total per night</td>
        								</tr>
                        <?php
                        $nights = explode('|', $wrapper->field_nights->value());
                        foreach ($nights as $key => $night) { ?>
                          <tr style="">
                            <td style=""><?php echo date('m/d/Y', strtotime($wrapper->field_check_in->value().' + '.($key).' days')); ?></td>
                            <td style=""><?php echo $night; ?></td>
                            <td width="40%" align="right" style="font-weight:bold;"><?php echo $night; ?></td>
                          </tr>
                        <?php } ?>
        							</table>
        						</td>
        					</tr>
        					<tr>
        						<td style="padding-top:15px;">
        							<span style="font-weight:bold; text-transform: uppercase;">Other charges, fees and savings in $USD</span>
        						</td>
        					</tr>
        					<tr>
        						<td>
        							<table style="width:100%; font-size:14px; line-height: 22px; border-bottom: dotted 1px #333333;">
        								<tr style="border-bottom: dotted 1px #333333; font-weight:bold; line-height: 40px;">
        									<td style="border-bottom: dotted 1px #333333;">Item</td>
        									<td width="40%" align="right" style="border-bottom: dotted 1px #333333;">Total</td>
        								</tr>
        								<tr style="">
        									<td style="">Tax Recovery Charges and Service Fees</td>
        									<td style="font-weight:bold" align="right"><?php echo $wrapper->field_tax_rate->value(); ?></td>
        								</tr>
        							</table>
        						</td>
        					</tr>
        				</table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #ffffff; background-color: #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#ffffff; font-size:14px; line-height: 22px; border-bottom: dotted 1px #333333; padding-bottom: 15px">
                      <span style="font-weight:bold; margin-right: 5px; text-transform: uppercase;">Total cost for entire stay in USD$</span>(Including tax recovery charges and service fees)
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <table style="width:100%; color:#ffffff; font-size:14px; line-height: 22px; border-bottom: dotted 1px #ffffff; padding-bottom: 15px;">
                        <tr style="padding-bottom: 15px; border-bottom: dotted 1px #ffffff;">
                          <td width="50%" style="padding-bottom: 15px; border-bottom: dotted 1px #ffffff;">Payment status</td>
                          <td style="text-align: right; padding-bottom: 15px; border-bottom: dotted 1px #ffffff;">Total cost of stay</td>
                        </tr>
                        <tr>
                          <td width="50%" style="font-size: 18px; padding-top: 15px;">PAID</td>
                          <td style="text-align: right; font-size: 18px;  padding-top: 15px;"><?php echo $wrapper->field_rate->value(); ?></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; ">Payment information</td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:14px; line-height:22px; border-bottom: dotted 1px #333333; padding-bottom: 15px">We have charged your credit card for the full payment of this reservation.</td>
                  </tr>
                  <tr>
                    <td>
                      <table style="width:100%;">
                        <tr>
                          <td style="color:#333333; font-size:18px; line-height: 22px; padding-top: 15px">
                            <span style="font-weight: bold; margin-right: 10px;">Payment card name:</span> <?php echo $wrapper->field_first_name->value().' '.$wrapper->field_last_name->value(); ?></td>
                        </tr>
                        <tr>
                          <td style="color:#333333; font-size:18px; line-height: 22px;">
                            <span style="font-weight: bold; margin-right: 10px;">Billing Address:</span> <?php echo $wrapper->field_adress_1->value(); ?></td>
                        </tr>
                        <tr>
                          <td style="color:#333333; font-size:18px; line-height: 22px; border-bottom: dotted 1px #333333; padding-bottom: 15px">
                            <span style="font-weight: bold; margin-right: 10px;">Itinerary Number:</span> <?php echo $wrapper->field_booking_id->value(); ?></td>
                        </tr>
                        <tr>
                          <td style="color:#333333; font-size:12px; line-height: 18px; padding-top: 15px">The above charges to your credit card were made by Travelscape, LLC. View our full <a target="_blank" href="http://travel.ian.com/index.jsp?pageName=userAgreement&locale=en_US&cid=456134" style="color:#7b8c88; text-decoration: none;">Terms & Conditions.</a></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px">Cancellation policy</td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:14px; font-weight:bold; line-height: 22px; padding-top: 15px">Room 1</td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:14px; line-height: 22px;"><?php echo $wrapper->field_policy_cancel->value(); ?></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td colspan="2" style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px">Customer support contact information</td>
                  </tr>
                  <tr>
                    <td style="padding-top: 15px;"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sites/all/themes/feflip/media/services/expedia-service-email.png"/></td>
                    <td style="padding-top: 15px; padding-left: 15px;"><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/booking-info/<?php echo $wrapper->field_booking_id->value(); ?>" style="color:#7b8c88; text-decoration: none;">Change or cancel your reservation with Expedia/TravelNow</a></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          </div>
          <?php break;
        case 'sabre': ?>
          <div style="background-color:#d9dfdE; font-family: Arial,sans-serif; font-size:14px; line-height: 22px; color: #333333;">
          <table style="width:640px; margin:auto; padding:0; border-collapse:collapse;">
            <tr style="height:20px;"></tr>
            <tr align="center" style="border-bottom: dotted 1px #333333;">
              <td valign="top" style="padding-bottom: 30px;">
                <img style="width:300px; margin: auto;" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sites/all/themes/feflip/media/brand/feather-and-flip-black-logo.png"/>
              </td>
            </tr>
            <tr style="height:20px;"></tr>
            <tr style="border-bottom: dotted 1px #333333;">
              <td style="text-transform: uppercase; font-size: 14px; color: #333333; line-height: 22px; padding-bottom: 20px;">Thank you for booking with Feather+Flip and Tzell Travel Group. We only recommend hotels we know and love, and we hope you feel the same way. Read on for your confirmation number, hotel cancellation policy and contact details.</td>
            </tr>
            <tr style="height:30px;"></tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td valign="top" style="padding-bottom: 20px;">
                    <img style="margin: auto;" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sites/all/themes/feflip/media/services/f+f-service-email.png"/>
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:14px; line-height: 22px; border-bottom: dotted 1px #333333; padding-bottom: 15px">The booking you recently made on the featherandflip.com website is confirmed. Your reservation details are below.</td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:18px; line-height: 22px; padding-top: 15px"><span style="font-weight: bold; margin-right: 10px;">Customer Name:</span> <?php echo $wrapper->field_first_name->value().' '.$wrapper->field_last_name->value(); ?></td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:18px; line-height: 22px;"><span style="font-weight: bold; margin-right: 10px;">Customer Email:</span> <?php echo $wrapper->field_email->value(); ?></td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:18px; line-height: 22px; border-bottom: dotted 1px #333333; padding-bottom: 15px"><span style="font-weight: bold; margin-right: 10px;">Itinerary Number:</span> <?php echo $wrapper->field_booking_id->value(); ?></td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:12px; line-height: 18px; padding-top: 15px">Please refer to your Itinerary Number if you contact customer service for any reason.</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px"><?php echo $wrapper->field_hotel_name->value(); ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top: 15px; border-bottom: dotted 1px #333333; padding-bottom: 15px">
                      <table style="margin: 0; padding-top: 15px;border-collapse:collapse; color:#333333; font-size:14px; line-height: 22px;">
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Address:</span><?php echo $wrapper->field_hotel_contact->value(); ?></td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Phone:</span>Phone</td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Fax:</span>Fax</td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Check-in:</span><?php echo $wrapper->field_check_in->value(); ?></td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Check-out:</span><?php echo $wrapper->field_check_out->value(); ?></td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Number of nights:</span><?php echo $wrapper->field_nights->value(); ?></td></tr>
                        <tr><td><span style="font-weight: bold; margin-right: 10px;">Number of guests:</span><?php echo $wrapper->field_adults->value()+$wrapper->field_children->value(); ?></td></tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px">room details</td>
                  </tr>
                  <tr>
                    <td>
                      <table style="width:100%; margin: 0; padding-top: 15px;border-collapse:collapse; color:#333333; font-size:14px; line-height: 22px;">
                        <tr style="font-weight: bold; padding-top: 30px; padding-bottom: 15px; border-bottom: dotted 1px #333333; ">
                          <td width="10%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">#</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">Room Type</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">Reserved for</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">Confirmation number</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">Refundable</td>
                        </tr>
                        <tr style="padding-top: 15px; padding-bottom: 15px; border-bottom: dotted 1px #333333;">
                          <td width="10%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">#</td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;"><?php echo $wrapper->field_room_type->value(); ?></td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;"><?php echo $wrapper->field_first_name->value().' '.$wrapper->field_last_name->value(); ?></td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;"><?php echo $wrapper->field_confirmation_number->value(); ?></td>
                          <td width="22%" valign="top" style="padding-top: 15px; padding-bottom: 15px;">NO</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:12px; padding-top: 15px;">*Please note: Preferences and special requests cannot be guaranteed. Special requests are subject to availability upon check-in and may incur additional charges.</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
        					<tr>
        						<td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px">charges</td>
        					</tr>
        					<tr>
        						<td style="padding-top:15px;">
        							<span style="font-weight:bold; text-transform: uppercase;">Cost per night and per room in USD$</span> (Excluding tax recovery charges and service fees)
        						</td>
        					</tr>
        					<tr>
        						<td>
        							<table style="width:100%; font-size:14px; line-height: 22px; border-bottom: dotted 1px #333333;">
        								<tr style="border-bottom: dotted 1px #333333; font-weight:bold; line-height: 40px;">
        									<td style="border-bottom: dotted 1px #333333;">Dates</td>
        									<td style="border-bottom: dotted 1px #333333;">Room 1</td>
        									<td width="40%" align="right" style="border-bottom: dotted 1px #333333;">Total per night</td>
        								</tr>
                        <?php
                        $nights = explode('|', $wrapper->field_nights->value());
                        foreach ($nights as $key => $night) { ?>
                          <tr style="">
                            <td style=""><?php echo date('m/d/Y', strtotime($wrapper->field_check_in->value().' + '.($key).' days')); ?></td>
                            <td style=""><?php echo $night; ?></td>
                            <td width="40%" align="right" style="font-weight:bold;"><?php echo $night; ?></td>
                          </tr>
                        <?php } ?>
        							</table>
        						</td>
        					</tr>
        					<tr>
        						<td style="padding-top:15px;">
        							<span style="font-weight:bold; text-transform: uppercase;">Other charges, fees and savings in $USD</span>
        						</td>
        					</tr>
        					<tr>
        						<td>
        							<table style="width:100%; font-size:14px; line-height: 22px; border-bottom: dotted 1px #333333;">
        								<tr style="border-bottom: dotted 1px #333333; font-weight:bold; line-height: 40px;">
        									<td style="border-bottom: dotted 1px #333333;">Item</td>
        									<td width="40%" align="right" style="border-bottom: dotted 1px #333333;">Total per night</td>
        								</tr>
        								<tr style="">
        									<td style="">Tax Recovery Charges and Service Fees</td>
        									<td style="font-weight:bold" align="right"><?php echo $wrapper->field_tax_rate->value(); ?></td>
        								</tr>
        							</table>
        						</td>
        					</tr>
				        </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #ffffff; background-color: #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#ffffff; font-size:14px; line-height: 22px; border-bottom: dotted 1px #333333; padding-bottom: 15px">
                      <span style="font-weight:bold; margin-right: 5px; text-transform: uppercase;">Total cost for entire stay in USD$</span>(Including tax recovery charges and service fees)
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <table style="width:100%; color:#ffffff; font-size:14px; line-height: 22px; border-bottom: dotted 1px #ffffff; padding-bottom: 15px;">
                        <tr style="padding-bottom: 15px; border-bottom: dotted 1px #ffffff;">
                          <td width="50%" style="padding-bottom: 15px; border-bottom: dotted 1px #ffffff;">Payment status</td>
                          <td style="text-align: right; padding-bottom: 15px; border-bottom: dotted 1px #ffffff;">Total cost of stay</td>
                        </tr>
                        <tr>
                          <td width="50%" style="font-size: 18px; padding-top: 15px;">Pay on arrival</td>
                          <td style="text-align: right; font-size: 18px;  padding-top: 15px;"><?php echo $wrapper->field_rate->value(); ?></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; ">Payment information</td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:14px; line-height:22px; border-bottom: dotted 1px #333333; padding-bottom: 15px"></td>
                  </tr>
                  <tr>
                    <td>
                      <table style="width:100%;">
                        <tr>
                          <td style="color:#333333; font-size:18px; line-height: 22px; padding-top: 15px">
                            <span style="font-weight: bold; margin-right: 10px;">Payment card name:</span> <?php echo $wrapper->field_first_name->value().' '.$wrapper->field_last_name->value(); ?></td>
                        </tr>
                        <tr>
                          <td style="color:#333333; font-size:18px; line-height: 22px;">
                            <span style="font-weight: bold; margin-right: 10px;">Billing Address:</span> <?php echo $wrapper->field_adress_1->value(); ?></td>
                        </tr>
                        <tr>
                          <td style="color:#333333; font-size:18px; line-height: 22px; border-bottom: dotted 1px #333333; padding-bottom: 15px">
                            <span style="font-weight: bold; margin-right: 10px;">Itinerary Number:</span> <?php echo $wrapper->field_booking_id->value(); ?></td>
                        </tr>
                        <tr>
                          <td style="color:#333333; font-size:12px; line-height: 18px; padding-top: 15px"> <a target="_blank" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/terms-service" style="color:#7b8c88; text-decoration: none;">Terms of service.</a></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px">Cancellation policy</td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:14px; font-weight:bold; line-height: 22px; padding-top: 15px">Room 1</td>
                  </tr>
                  <tr>
                    <td style="color:#333333; font-size:14px; line-height: 22px;"><?php echo $wrapper->field_policy_cancel->value(); ?></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width:100%; border: solid 1px #333333; padding: 60px; border-radius: 5px; margin-bottom: 30px;">
                  <tr>
                    <td colspan="2" style="color:#333333; font-size:18px; font-weight:bold; line-height: 22px; text-transform: uppercase; border-bottom: dotted 1px #333333; padding-bottom: 15px">Customer support contact information</td>
                  </tr>
                  <tr>
                    <td style="padding-top: 15px; ">To change or cancel your booking, or if you’d like additional travel services, call Tzell Travel Group at 800-482-8785. Beyond the business hours of Monday through Friday, 9 am - 6 pm EST, call 800-482-8785 and use code M79H. Fees will apply.</td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          </div>
          <?php break;
        default:
          break;
      }
    }

  ?>
<?php endif; ?>
