===source===
<?php
declare(ticks=<<<E
x$a
E);
===errors===
declare(ticks) value must be a literal
===php_error===
PHP Fatal error:  declare(ticks) value must be a literal in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Heredoc": {
                    "label": "E",
                    "parts": [
                      {
                        "Literal": "x"
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 26,
                            "end": 28
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 20,
                  "end": 30
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
