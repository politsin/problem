<?php

namespace Drupal\problem\Controller;

/**
 * @file
 * Contains \Drupal\synapse\Controller\PageForms.
 */
use Drupal\Core\Controller\ControllerBase;
use Drupal\problem\Controller\GetContactForm;

/**
 * Controller routines for page example routes.
 */
class PageForms extends ControllerBase {

  /**
   * Page Callback.
   */
  public function pageOutput() {
    $output = [];
    $output['info'] = [
      '#markup' => '<h2>Форма, котороую нарисовали много раз</h2>',
      '#allowed_tags' => ['style', 'svg', 'g', 'path'],
    ];
    $wrapper = '<div id="form-results"><pre>Results placeholder</pre></div>';
    $output['wrapper'] = ['#markup' => $wrapper];

    $extra = [
      'wrapper' => FALSE,
      'key' => 'problem_default_form',
      'i' => 'default',
    ];
    $output['form'] = \Drupal::formBuilder()->getForm('Drupal\problem\Form\MultiForm', $extra);
    for ($i = 0; $i < 5; $i++) {
      $extra['key'] = 'problem-form-key-' . $i;
      $extra['i'] = $i;
      $output['form-' . $i] = \Drupal::formBuilder()->getForm('Drupal\problem\Form\MultiForm', $extra);
    }
    for ($i = 0; $i < 3; $i++) {
      $extra['i'] = $i;
      $output['contact-' . $i] = GetContactForm::form($form_name = 'callback');
    }
    $output['br'] = ['#markup' => '<br><br><br><br>'];
    return $output;
  }

}
