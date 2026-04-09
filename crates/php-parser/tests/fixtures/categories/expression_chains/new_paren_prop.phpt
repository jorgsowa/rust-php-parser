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
                            "end": 14,
                            "start_line": 1,
                            "start_col": 11
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 14,
                      "start_line": 1,
                      "start_col": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "property": {
                "kind": {
                  "Identifier": "prop"
                },
                "span": {
                  "start": 17,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22,
    "start_line": 1,
    "start_col": 0
  }
}
