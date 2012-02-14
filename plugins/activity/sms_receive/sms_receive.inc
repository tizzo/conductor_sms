<?php

$plugin = array(
  'title' => t('SMS Recieve'),
  'description' => t('This action receives an SMS message as input from the sms framework, pausing the workflow if SMS info has not already been received.'),
  'handler' => array(
    'class' => 'ConductorActivitySMSReceive',
  ),
);
