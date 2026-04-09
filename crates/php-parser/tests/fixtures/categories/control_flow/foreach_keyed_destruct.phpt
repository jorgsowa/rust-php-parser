===source===
<?php foreach ($arr as $k => [$a, $b]) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "arr"
            },
            "span": {
              "start": 15,
              "end": 19,
              "start_line": 1,
              "start_col": 15
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 23,
              "end": 25,
              "start_line": 1,
              "start_col": 23
            }
          },
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 30,
                      "end": 32,
                      "start_line": 1,
                      "start_col": 30
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 30,
                    "end": 32,
                    "start_line": 1,
                    "start_col": 30
                  }
                },
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 34,
                      "end": 36,
                      "start_line": 1,
                      "start_col": 34
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 34,
                    "end": 36,
                    "start_line": 1,
                    "start_col": 34
                  }
                }
              ]
            },
            "span": {
              "start": 29,
              "end": 37,
              "start_line": 1,
              "start_col": 29
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 39,
              "end": 41,
              "start_line": 1,
              "start_col": 39
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 41,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41,
    "start_line": 1,
    "start_col": 0
  }
}
