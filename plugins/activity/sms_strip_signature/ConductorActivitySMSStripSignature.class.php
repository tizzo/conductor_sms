<?php

/**
 * This is the first activity in any workflow.
 */
class ConductorActivitySMSStripSignature extends ConductorActivity {

  /**
   * The start method performs no actions.
   */
  public function run($workflow) {
    $state = $this->getState();
    $context = $state->getContext();
    $smsMessages = array();
    foreach ($context as $key => $value) {
      if (strrpos($key, ':message') !== FALSE) {
        $smsMessages[$key] = $value;
      }
    }
    $smsMessages = $this->stripCommonSignature($smsMessages);
    foreach ($smsMessages as $key => $value) {
      $state->setContext($key, $value);
    }
    $state->markCompeted();
  }

  /**
   * Given an array of strings that may end in a common signature, strip the common trailing letters.
   *
   * @param $strings
   *   An associative array of strings that may share a common signature.
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
