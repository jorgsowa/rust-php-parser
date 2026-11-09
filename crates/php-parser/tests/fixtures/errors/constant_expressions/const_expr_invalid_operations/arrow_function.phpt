===source===
<?php
const V = fn() => 1;
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
              "name": "V",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "ArrowFunction": {
                  "is_static": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 24,
                      "end": 25
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 25
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
