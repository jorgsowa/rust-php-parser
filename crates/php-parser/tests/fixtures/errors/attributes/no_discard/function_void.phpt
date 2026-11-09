===source===
<?php
#[NoDiscard] function f(): void {}
===errors >=8.5===
A void function does not return a value, but #[\NoDiscard] requires a return value
===php_error >=8.5===
PHP Fatal error:  A void function does not return a value, but #[\NoDiscard] requires a return value in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 40
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 28,
              "end": 29
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
                  "start": 33,
                  "end": 37
                }
              }
            },
            "span": {
              "start": 33,
              "end": 37
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
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
