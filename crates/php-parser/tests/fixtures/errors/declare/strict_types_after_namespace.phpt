===source===
<?php
namespace A;
declare(strict_types=1);
===errors===
strict_types declaration must be the very first statement in the script
===php_error===
PHP Fatal error:  strict_types declaration must be the very first statement in the script in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
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
                  "start": 40,
                  "end": 41
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 19,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
