===source===
<?php
__FUNCTION__();
===errors===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 2
===php_error >=8.0===
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
                  "MagicConst": "Function"
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "args": []
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
