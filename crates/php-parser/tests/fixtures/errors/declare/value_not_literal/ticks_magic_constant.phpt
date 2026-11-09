===source===
<?php
declare(ticks=__LINE__);
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
                  "MagicConst": "Line"
                },
                "span": {
                  "start": 20,
                  "end": 28
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
