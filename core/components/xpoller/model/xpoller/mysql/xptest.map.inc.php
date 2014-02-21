<?php
$xpdo_meta_map['xpTest']= array (
  'package' => 'xpoller',
  'version' => '1.1',
  'table' => 'xpoller_tests',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'name' => '',
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
  'composites' => 
  array (
    'Questions' => 
    array (
      'class' => 'xpQuestion',
      'local' => 'id',
      'foreign' => 'pid',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
