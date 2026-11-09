===source===
<?php
#[NoDiscard] function g(): never { exit; }
===errors >=8.5===
A never returning function does not return a value, but #[\NoDiscard] requires a return value
===php_error >=8.5===
PHP Fatal error:  A never returning function does not return a value, but #[\NoDiscard] requires a return value in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 48
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
              "start": 28,
              "end": 29
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Exit": null
                  },
                  "span": {
                    "start": 41,
                    "end": 45
                  }
                }
              },
              "span": {
                "start": 41,
                "end": 46
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 33,
                  "end": 38
                }
              }
            },
            "span": {
              "start": 33,
              "end": 38
            }
          },
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 17
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 17
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
