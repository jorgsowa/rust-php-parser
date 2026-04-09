===source===
<?php foreach ($items as $k => $v) { echo $k; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "items"
            },
            "span": {
              "start": 15,
              "end": 21,
              "start_line": 1,
              "start_col": 15
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 25,
              "end": 27,
              "start_line": 1,
              "start_col": 25
            }
          },
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 31,
              "end": 33,
              "start_line": 1,
              "start_col": 31
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "k"
                        },
                        "span": {
                          "start": 42,
                          "end": 44,
                          "start_line": 1,
                          "start_col": 42
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 37,
                    "end": 46,
                    "start_line": 1,
                    "start_col": 37
                  }
                }
              ]
            },
            "span": {
              "start": 35,
              "end": 47,
              "start_line": 1,
              "start_col": 35
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 47,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}
