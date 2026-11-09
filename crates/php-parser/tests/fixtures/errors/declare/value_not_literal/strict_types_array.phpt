===source===
<?php
declare(strict_types=[1]);
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 28,
                            "end": 29
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 29
                      }
                    }
                  ]
                },
                "span": {
                  "start": 27,
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
