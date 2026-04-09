===config===
min_php=8.5
===source===
<?php clone($x, $y, $z);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "clone"
                },
                "span": {
                  "start": 6,
                  "end": 11,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 12,
                      "end": 14,
                      "start_line": 1,
                      "start_col": 12
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 12,
                    "end": 14,
                    "start_line": 1,
                    "start_col": 12
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "y"
                    },
                    "span": {
                      "start": 16,
                      "end": 18,
                      "start_line": 1,
                      "start_col": 16
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 18,
                    "start_line": 1,
                    "start_col": 16
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "z"
                    },
                    "span": {
                      "start": 20,
                      "end": 22,
                      "start_line": 1,
                      "start_col": 20
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 22,
                    "start_line": 1,
                    "start_col": 20
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
