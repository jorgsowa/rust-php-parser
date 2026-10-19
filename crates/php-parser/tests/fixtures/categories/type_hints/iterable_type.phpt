===source===
<?php function f(iterable $x): iterable {}
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
                  "start": 26,
                  "end": 28
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "iterable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 25
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 28
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "iterable"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 31,
                  "end": 39
                }
              }
            },
            "span": {
              "start": 31,
              "end": 39
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
