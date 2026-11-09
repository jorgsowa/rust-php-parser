===source===
<?php
declare(ticks=1 + 1);
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    }
                  }
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
