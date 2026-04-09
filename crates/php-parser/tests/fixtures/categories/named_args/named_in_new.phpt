===source===
<?php new Foo(x: 1, y: 2);
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
                  "name": "x",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 17,
                      "end": 18,
                      "start_line": 1,
                      "start_col": 17
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 18,
                    "start_line": 1,
                    "start_col": 14
                  }
                },
                {
                  "name": "y",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 23,
                      "end": 24,
                      "start_line": 1,
                      "start_col": 23
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 24,
                    "start_line": 1,
                    "start_col": 20
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26,
    "start_line": 1,
    "start_col": 0
  }
}
