===config===
min_php=8.2
===source===
<?php function f(): true|null { return null; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 39,
                    "end": 43
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 44
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
                        "true"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 24
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 24
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "null"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 25,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 29
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 29
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
