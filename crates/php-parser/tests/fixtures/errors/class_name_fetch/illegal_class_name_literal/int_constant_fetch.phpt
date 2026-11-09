===source===
<?php
(1)::A;
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
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 7,
                      "end": 8
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "member": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
