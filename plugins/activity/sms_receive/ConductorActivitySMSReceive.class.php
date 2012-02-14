<?php

/**
 * This is the first activity in any workflow.
 */
class ConductorActivitySMSReceive extends ConductorActivity {

  /**
   * The start method performs no actions.
   */
  public function process() {
    if (!isset($this->context[$this->name . ':number']) || isset($this->context[$this->name . ':message']) {
      return FALSE;
    }
    return TRUE;
  }

}
