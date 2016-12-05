<?php

namespace Drupal\problem\Controller;

/**
 * @file
 * Contains \Drupal\app\Controller\AjaxResult.
 */

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Controller routines for page example routes.
 */
class AjaxResult extends ControllerBase {

  /**
   * AJAX Responce.
   */
  public static function ajax($wrapper, $otvet, $commands = FALSE) {
    $output  = '';
    $output .= '<pre>';
    $output .= $otvet;
    if ($commands) {
      $output .= implode("\n", $commands);
    }
    $output .= '</pre>';
    $response = new AjaxResponse();
    $response->addCommand(new HtmlCommand("#" . $wrapper, $output));
    return $response;
  }

}
