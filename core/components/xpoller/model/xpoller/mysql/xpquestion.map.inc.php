<?php
$xpdo_meta_map['xpQuestion']= array (
  'package' => 'xpoller',
  'version' => '1.1',
  'table' => 'xpoller_questions',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'tid' => 0,
    'text' => '',
    'closed' => 0,
    'rank' => 0,
    'type' => 'radio',
  ),
  'fieldMeta' => 
  array (
    'tid' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'text' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'text',
      'null' => true,
      'default' => '',
    ),
    'closed' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'rank' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '10',
      'phptype' => 'string',
      'null' => false,
      'default' => 'radio',
    ),
  ),
  'indexes' => 
  array (
    'tid' => 
    array (
      'alias' => 'tid',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'tid' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'rank' => 
    array (
      'alias' => 'rank',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'rank' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'closed' => 
    array (
      'alias' => 'closed',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'closed' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'composites' => 
  array (
    'Options' => 
    array (
      'class' => 'xpOption',
      'local' => 'id',
      'foreign' => 'qid',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Answers' => 
    array (
      'class' => 'xpAnswer',
      'local' => 'id',
      'foreign' => 'qid',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'Test' => 
    array (
      'class' => 'xpTest',
      'local' => 'tid',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
