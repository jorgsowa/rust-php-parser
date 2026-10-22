===source===
<?php function f(): never { throw new \Exception(); }
===ast >=8.0===
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
          "params": [],
          "body": [
            {
              "kind": {
                "Throw": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "Exception"
                            ],
                            "kind": "FullyQualified",
                            "span": {
                              "start": 38,
                              "end": 48
                            }
                          }
                        },
                        "span": {
                          "start": 38,
                          "end": 48
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 34,
                    "end": 50
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 51
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
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
