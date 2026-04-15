===source===
<?php
echo 1;
echo 2;
namespace A;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 11,
              "end": 12
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 2
            },
            "span": {
              "start": 19,
              "end": 20
            }
          }
        ]
      },
      "span": {
        "start": 14,
        "end": 21
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
              "start": 32,
              "end": 33
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 22,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
===php_error===
PHP Fatal error:  Namespace declaration statement has to be the very first statement or after any declare call in the script in Standard input code on line 4
Stack trace:
#0 {main}
