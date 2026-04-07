===source===
<?php (new Foo)->prop;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 11,
                            "end": 14
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "property": {
                "kind": {
                  "Identifier": "prop"
                },
                "span": {
                  "start": 17,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
