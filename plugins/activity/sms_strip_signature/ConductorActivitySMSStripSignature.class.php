<?php

/**
 * This is the first activity in any workflow.
 */
class ConductorActivitySMSReceive extends ConductorActivity {

  /**
   * The start method performs no actions.
   */
  public function process() {
    /*
    if (!isset($this->context[$this->name . ':number']) || isset($this->context[$this->name . ':message']) {
      return FALSE;
    }
    return TRUE;
    */
  }

  /**
   *
   */
  public function stripCommonSignature(array $strings) {
    $string_arrays = array();
    foreach ($strings as $string) {
      $string_arrays[] = array_reverse(str_split($string));
    }
    $first_string = reset($string_arrays);
    $signature_length = 0;
    foreach ($first_string as $offset => $character) {
      $match = TRUE;
      foreach ($string_arrays as $string) {
        if (isset($string[$offset]) && $string[$offset] != $character) {
          $match = FALSE;
          $signature_length = $offset;
          break;
        }
      }
      if (!$match) {
        break;
      }
    }
    foreach ($strings as &$string) {
      $string = substr($string, 0, (strlen($string) - $signature_length));
    }
    return $strings;
  }

}
