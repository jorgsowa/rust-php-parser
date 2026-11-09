===source===
<?php
([])::A;
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
                      "Array": []
                    },
                    "span": {
                      "start": 7,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "member": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 12,
                  "end": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
