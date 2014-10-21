<?php
return [
  'version' => 2,
  'waiters' => [
  'TableExists' =>
  [
    'description' => 'Wait until a table exists and can be accessed',
    'operation' => 'DescribeTable',
    'delay' => 5,
    'maxAttempts' => 40,
    'acceptors' =>
    [
      0 =>
      [
        'state' => 'success',
        'matcher' => 'path',
        'argument' => 'Table.TableStatus',
        'expected' => 'ACTIVE',
      ],
      1 =>
      [
        'state' => 'retry',
        'matcher' => 'error',
        'expected' => 'ResourceNotFoundException',
      ],
    ],
  ],
  'TableNotExists' =>
  [
    'operation' => 'DescribeTable',
    'delay' => 5,
    'maxAttempts' => 40,
    'acceptors' =>
    [
      0 =>
      [
        'state' => 'success',
        'matcher' => 'error',
        'expected' => 'ResourceNotFoundException',
      ],
      1 =>
      [
        'state' => 'retry',
        'matcher' => 'status',
        'expected' => 200,
      ],
    ],
  ],
  ],
];