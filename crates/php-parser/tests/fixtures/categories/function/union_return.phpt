===source===
<?php function foo(): int|string { return 1; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 42,
                    "end": 43
                  }
                }
              },
              "span": {
                "start": 35,
                "end": 45
              }
            }
          ],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 22,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 25
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "string"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 26,
                        "end": 32
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 32
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 32
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
