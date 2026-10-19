===source===
<?php
<<<X
a
X();
===errors===
Cannot dereference this expression
===php_error===
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
                  "Heredoc": {
                    "label": "X",
                    "parts": [
                      {
                        "Literal": "a"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
