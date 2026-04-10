===config===
parse_version=8.1
===source===
<?php function f(): never { throw new \Exception(); }
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
                "Throw": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Identifier": "\\Exception"
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
