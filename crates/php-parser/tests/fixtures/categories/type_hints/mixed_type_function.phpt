===source===
<?php function anything(mixed $x): mixed { return $x; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "anything",
            "span": {
              "start": 15,
              "end": 23
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 30,
                  "end": 32
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
                      "start": 24,
                      "end": 29
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 29
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 24,
                "end": 32
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 50,
                    "end": 52
                  }
                }
              },
              "span": {
                "start": 43,
                "end": 53
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "mixed"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 35,
                  "end": 40
                }
              }
            },
            "span": {
              "start": 35,
              "end": 40
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
