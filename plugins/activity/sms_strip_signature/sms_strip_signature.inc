<?php

$plugin = array(
  'title' => t('SMS Strip Signature'),
  'description' => t('This action iterates over all sms messages received in sms activities before it and strips common sms signatures.'),
  'handler' => array(
    'class' => 'ConductorActivitySMSStripSignature',
  ),
);
