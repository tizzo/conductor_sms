<?php

/**
 * This is the first activity in any workflow.
 */
class ConductorActivitySMSPrompt extends ConductorActivity {

  public $attribute = '';

  public $question = '';

  public function option_definition() {
    $options = parent::option_definition();
    // The attribute to set in context.
    $options['attribute'] = array('default' => '');
    $options['question'] = array('default' => '');
    return $options;
  }


  /**
   * The start method performs no actions.
   */
  public function run() {
    $state = $this->getState();
    if (!$state->getContext('sms_number')) {
      $state->activityState->markFailed();
    }
    else if ($state->getContext($this->name . ':message') == FALSE) {
      sms_mobile_commons_send($state->getContext('sms_number'), $this->question);
      $state->markSuspended();
    }
    else {
      $state->markCompeted();
    }
  }

  /**
   * Implements ConductorActivity::getSuspendPointers().
   */
  public function getSuspendPointers() {
    return array(
      'sms_prompt:' . $this->getState()->getContext('sms_number')
    );
  }
}
