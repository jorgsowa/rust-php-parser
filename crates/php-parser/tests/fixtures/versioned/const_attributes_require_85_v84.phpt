===config===
min_php=8.4
===source===
<?php #[MyAttr] const VERSION = '8.5';
===errors===
'attributes on constants' requires PHP 8.5 or higher (targeting PHP 8.4)
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "VERSION",
            "value": {
              "kind": {
                "String": "8.5"
              },
              "span": {
                "start": 32,
                "end": 37
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "MyAttr"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 8,
                    "end": 14
                  }
                },
                "args": [],
                "span": {
                  "start": 8,
                  "end": 14
                }
              }
            ],
            "span": {
              "start": 22,
              "end": 37
            }
          }
        ]
      },
      "span": {
        "start": 16,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
