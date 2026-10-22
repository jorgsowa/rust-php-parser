===source===
<?php
__DIR__::class;
===errors===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '::' (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 2
===php_error >=8.0===
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
                  "MagicConst": "Dir"
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 15,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
