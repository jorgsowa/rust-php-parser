===source===
<?php
__FILE__::f();
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
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "MagicConst": "File"
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "method": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 16,
                  "end": 17
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
