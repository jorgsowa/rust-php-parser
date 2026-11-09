===source===
<?php
declare(ticks=`x`);
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
                  "ShellExec": [
                    {
                      "Literal": "x"
                    }
                  ]
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
