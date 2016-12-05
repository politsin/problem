<?php

namespace Drupal\problem\Controller;

/**
 * @file
 * Contains \Drupal\synapse\Controller\Page.
 */

/**
 * Company Info.
 */
class GetContactForm {

  /**
   * Form.
   */
  public static function form($form_name = 'callback', $button = 'Заказать') {
    $entity = \Drupal::entityManager()
      ->getStorage('contact_form')
      ->load($form_name);

    $message = \Drupal::entityManager()
      ->getStorage('contact_message')
      ->create(['contact_form' => $entity->id()]);

    $form = \Drupal::service('entity.form_builder')->getForm($message);
    $form['actions']['submit']['#value'] = $button;

    return $form;
  }

}
