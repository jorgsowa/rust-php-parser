===source===
<?php
(null)::A;
===errors===
Illegal class name
===php_error===
PHP Fatal error:  Illegal class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": "Null",
                    "span": {
                      "start": 7,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "member": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 14,
                  "end": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
