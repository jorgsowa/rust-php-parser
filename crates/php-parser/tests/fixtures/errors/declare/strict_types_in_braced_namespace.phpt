===source===
<?php
declare(strict_types=1);
namespace A {
    declare(strict_types=1);
}
===errors===
strict_types declaration must be the very first statement in the script
===php_error===
PHP Fatal error:  strict_types declaration must be the very first statement in the script in Standard input code on line 4
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
                  "Int": 1
                },
                "span": {
                  "start": 27,
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
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 41,
              "end": 42
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Declare": {
                    "directives": [
                      [
                        "strict_types",
                        {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 70,
                            "end": 71
                          }
                        }
                      ]
                    ],
                    "body": null
                  }
                },
                "span": {
                  "start": 49,
                  "end": 73
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 31,
        "end": 75
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 75
  }
}
