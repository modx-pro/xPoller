<?php
$xpdo_meta_map['xpAnswer']= array (
  'package' => 'xpoller',
  'version' => '1.1',
  'table' => 'xpoller_answers',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'uid' => 0,
    'qid' => 0,
    'oid' => 0,
    'timestamp' => 'CURRENT_TIMESTAMP',
  ),
  'fieldMeta' => 
  array (
    'uid' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'qid' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'oid' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'timestamp' => 
    array (
      'dbtype' => 'timestamp',
      'phptype' => 'timestamp',
      'null' => false,
      'default' => 'CURRENT_TIMESTAMP',
    ),
  ),
  'indexes' => 
  array (
    'key' => 
    array (
      'alias' => 'key',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'uid' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'qid' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
        'oid' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'timestamp' => 
    array (
      'alias' => 'timestamp',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'timestamp' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'User' => 
    array (
      'class' => 'modUser',
      'local' => 'uid',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Question' => 
    array (
      'class' => 'xpQuestion',
      'local' => 'qid',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Option' => 
    array (
      'class' => 'xpOption',
      'local' => 'oid',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
