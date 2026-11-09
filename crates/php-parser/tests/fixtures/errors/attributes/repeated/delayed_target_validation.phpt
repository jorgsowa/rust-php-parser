===source===
<?php
#[DelayedTargetValidation, DelayedTargetValidation] function g() {}
===errors >=8.5===
Attribute "DelayedTargetValidation" must not be repeated
===php_error >=8.5===
PHP Fatal error:  Attribute "DelayedTargetValidation" must not be repeated in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 73
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 67,
              "end": 68
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 31
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 31
              }
            },
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 33,
                  "end": 56
                }
              },
              "args": [],
              "span": {
                "start": 33,
                "end": 56
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
