===source===
<?php function f(mixed $x): mixed {}
===errors <=7.4===
'mixed type' requires PHP 8.0 or higher
'mixed type' requires PHP 8.0 or higher
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 23,
                  "end": 25
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "mixed"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 22
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 25
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "mixed"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 28,
                  "end": 33
                }
              }
            },
            "span": {
              "start": 28,
              "end": 33
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
