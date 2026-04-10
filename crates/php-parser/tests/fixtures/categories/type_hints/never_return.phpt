===source===
<?php function abort(): never { throw new Exception(); }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "abort",
          "params": [],
          "body": [
            {
              "kind": {
                "Throw": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Identifier": "Exception"
                        },
                        "span": {
                          "start": 42,
                          "end": 51
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 38,
                    "end": 53
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 54
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
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
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
