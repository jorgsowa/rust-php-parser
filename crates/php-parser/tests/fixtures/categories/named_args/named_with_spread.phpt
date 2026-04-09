===source===
<?php foo(...$extra, name: 'test');
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
                  "Identifier": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 9,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "extra"
                    },
                    "span": {
                      "start": 13,
                      "end": 19,
                      "start_line": 1,
                      "start_col": 13
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 19,
                    "start_line": 1,
                    "start_col": 10
                  }
                },
                {
                  "name": "name",
                  "value": {
                    "kind": {
                      "String": "test"
                    },
                    "span": {
                      "start": 27,
                      "end": 33,
                      "start_line": 1,
                      "start_col": 27
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 33,
                    "start_line": 1,
                    "start_col": 21
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 34,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
