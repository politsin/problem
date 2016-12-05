<?php

namespace Drupal\problem\Form;

/**
 * @file
 * Contains Drupal\node_app\Form\RestConteiner.
 */

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\problem\Controller\AjaxResult;

/**
 * R.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class MultiForm extends FormBase {

  /**
   * AJAX Wrapper.
   *
   * @var wrapper
   */
  private $wrapper = 'form-results';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'problem_forms';
  }

  /**
   * F ajaxSubmit.
   */
  public function ajaxSubmit(array &$form, FormStateInterface $form_state) {
    $extra = $form_state->extra;
    $otvet  = "AjaxReDruapl:\n";
    $otvet  .= "Extra[i]:" . $extra['i'] . "\n";
    $otvet  .= "<b>POST:</b>\n";
    foreach ($_POST as $key => $value) {
      $otvet .= $key . ":" . $value . "\n";
    }
    return AjaxResult::ajax($this->wrapper, $otvet);
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $extra = NULL) {

    $form_state->extra = $extra;
    $form_state->setCached(FALSE);
    if ($extra['wrapper']) {
      $form['#suffix'] = '<div id="' . $this->wrapper . '"></div>';
    }

    $form['#attributes']['class'][] = 'inline';
    $form['button'] = [
      '#type' => 'submit',
      '#value' => $this->t('Form') . ' ' . $extra['i'],
      '#attributes' => ['class' => ['btn', 'btn-xs', 'btn-success']],
      '#ajax'   => [
        'callback' => '::ajaxSubmit',
        'effect'   => 'fade',
        'progress' => ['type' => 'throbber', 'message' => ""],
      ],
    ];
    $form['hidden'] = [
      '#type' => 'hidden',
      '#value' => $extra['i'],
    ];
    return $form;
  }

  /**
   * Implements a form submit handler.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRebuild(TRUE);
  }

}
