===config===
min_php=8.2
===source===
<?php function f(): false|null { return null; }
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
                    "start": 40,
                    "end": 44
                  }
                }
              },
              "span": {
                "start": 33,
                "end": 46
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
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 25
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
                        "start": 26,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 30
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
