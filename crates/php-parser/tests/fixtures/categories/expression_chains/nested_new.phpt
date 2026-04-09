===source===
<?php new Foo(new Bar());
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 10,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 10
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Bar"
                          },
                          "span": {
                            "start": 18,
                            "end": 21,
                            "start_line": 1,
                            "start_col": 18
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 14,
                      "end": 23,
                      "start_line": 1,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 23,
                    "start_line": 1,
                    "start_col": 14
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25,
    "start_line": 1,
    "start_col": 0
  }
}
