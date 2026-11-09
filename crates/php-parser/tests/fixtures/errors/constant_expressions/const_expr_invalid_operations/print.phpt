===source===
<?php
const M = print 1;
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "M",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Print": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 22,
                    "end": 23
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 23
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 23
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
