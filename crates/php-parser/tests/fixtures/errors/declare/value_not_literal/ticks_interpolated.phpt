===source===
<?php
declare(ticks="a$b");
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
                  "InterpolatedString": [
                    {
                      "Literal": "a"
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 22,
                          "end": 24
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 20,
                  "end": 25
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
