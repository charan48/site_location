<?php

namespace Drupal\site_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class LocationConfigurationForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'site_location_configuration_form.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'location_configuration_form';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config(static::SETTINGS);

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#default_value' => $config->get('timezone'),
      '#options' => [
        'chicago' => $this
          ->t('America/Chicago'),
        'new_york' => $this
          ->t('America/New_York'),
        'tokyo' => $this
          ->t('Asia/Tokyo'),
        'dubai' => $this
          ->t('Asia/Dubai'),
        'kolkata' => $this
          ->t('Asia/Kolkata'),
        'amsterdamv' => $this
          ->t('Europe/Amsterdam'),
        'oslo' => $this
          ->t('Europe/Oslo'),
        'london' => $this
          ->t('Europe/London'),
      ],
      '#default_value' => $config->get('timezone'),
    ];

    return parent::buildForm($form, $form_state);

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->config(static::SETTINGS)
    ->set('country', $form_state->getValue('country'))
    ->set('city', $form_state->getValue('city'))
    ->set('timezone', $form_state->getValue('timezone'))
    ->save();

    parent::submitForm($form, $form_state);

  }

}
