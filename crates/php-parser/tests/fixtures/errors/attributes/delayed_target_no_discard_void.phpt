===source===
<?php
#[DelayedTargetValidation] #[NoDiscard] function f(): void {}
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
===errors >=8.5===
A void function does not return a value, but #[\NoDiscard] requires a return value
===php_error >=8.5===
PHP Fatal error:  A void function does not return a value, but #[\NoDiscard] requires a return value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 55,
              "end": 56
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 60,
                  "end": 64
                }
              }
            },
            "span": {
              "start": 60,
              "end": 64
            }
          },
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
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 35,
                  "end": 44
                }
              },
              "args": [],
              "span": {
                "start": 35,
                "end": 44
              }
            }
          ]
        }
      },
      "span": {
        "start": 46,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
