===source===
<?php
__LINE__::$a;
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
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "MagicConst": "Line"
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "member": {
                "kind": {
                  "Identifier": "a"
                },
                "span": {
                  "start": 16,
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
