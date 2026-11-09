===source===
<?php
const L = match (1) { default => 1 };
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
Constant expression contains invalid operations
===errors >=8.0===
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'default' (T_DEFAULT) in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "L",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Match": {
                  "subject": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 23,
                      "end": 24
                    }
                  },
                  "arms": [
                    {
                      "conditions": null,
                      "body": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 39,
                          "end": 40
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 40
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 42
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 42
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
