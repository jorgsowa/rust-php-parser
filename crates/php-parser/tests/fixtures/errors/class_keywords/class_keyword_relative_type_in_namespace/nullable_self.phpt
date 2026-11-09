===source===
<?php
namespace N;
function f(): ?namespace\self {}
===errors===
Cannot use "self" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
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
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "self"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 34,
                      "end": 48
                    }
                  }
                },
                "span": {
                  "start": 34,
                  "end": 48
                }
              }
            },
            "span": {
              "start": 33,
              "end": 48
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
