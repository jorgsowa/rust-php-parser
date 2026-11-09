===source===
<?php
declare(strict_types=-0);
===errors===
declare(strict_types) value must be a literal
===php_error===
PHP Fatal error:  declare(strict_types) value must be a literal in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 28,
                        "end": 29
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 29
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
