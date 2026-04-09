===source===
<?php func(...$args, last: 'end');
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
                  "Identifier": "func"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "args"
                    },
                    "span": {
                      "start": 14,
                      "end": 19,
                      "start_line": 1,
                      "start_col": 14
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 19,
                    "start_line": 1,
                    "start_col": 11
                  }
                },
                {
                  "name": "last",
                  "value": {
                    "kind": {
                      "String": "end"
                    },
                    "span": {
                      "start": 27,
                      "end": 32,
                      "start_line": 1,
                      "start_col": 27
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 32,
                    "start_line": 1,
                    "start_col": 21
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 33,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}
