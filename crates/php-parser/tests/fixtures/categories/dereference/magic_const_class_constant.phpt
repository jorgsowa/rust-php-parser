===source===
<?php
__CLASS__::X;
===errors===
Cannot dereference this expression
===php_error===
PHP Parse error:  syntax error, unexpected token "::" in Standard input code on line 2
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
                  "MagicConst": "Class"
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "member": {
                "kind": {
                  "Identifier": "X"
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
