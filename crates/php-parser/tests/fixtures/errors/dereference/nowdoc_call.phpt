===source===
<?php
<<<'X'
a
X();
===errors===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 4
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 4
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
                  "Nowdoc": {
                    "label": "X",
                    "value": "a"
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "args": []
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
