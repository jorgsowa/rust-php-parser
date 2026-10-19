===source===
<?php
function f(INT\X $a, Mixed\Y $b) {}
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
                "name": "a",
                "span": {
                  "start": 23,
                  "end": 25
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "INT",
                      "X"
                    ],
                    "kind": "Qualified",
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
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Mixed",
                      "Y"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 27,
                      "end": 34
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 34
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 27,
                "end": 37
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
