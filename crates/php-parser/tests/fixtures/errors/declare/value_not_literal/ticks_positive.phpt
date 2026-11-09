===source===
<?php
declare(ticks=+1);
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
                  "UnaryPrefix": {
                    "op": "Plus",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 21,
                        "end": 22
                      }
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 22
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
