<?php
function feflip_form_system_theme_settings_alter(&$form, $form_state) {
  $form['sabre_app_name'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Sabre: Application name'),
    '#default_value' => theme_get_setting('sabre_app_name'),
    '#description'   => t("Sabre app name."),
  );
  $form['sabre_client_id'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Sabre: Client ID'),
    '#default_value' => theme_get_setting('sabre_client_id'),
    '#description'   => t("Sabre app client ID."),
  );
  $form['sabre_client_secret'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Sabre: Client secret'),
    '#default_value' => theme_get_setting('sabre_client_secret'),
    '#description'   => t("Sabre app client secret."),
  );
}