===source===
<?php
__NAMESPACE__();
===errors===
Cannot dereference this expression
===php_error===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "MagicConst": "Namespace"
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
