===source===
<?php foreach ($a as $b):
    echo $b;
} endforeach;
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17,
              "start_line": 1,
              "start_col": 15
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 21,
              "end": 23,
              "start_line": 1,
              "start_col": 21
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
                          "Variable": "b"
                        },
                        "span": {
                          "start": 35,
                          "end": 37,
                          "start_line": 2,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 30,
                    "end": 39,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                {
                  "kind": "Error",
                  "span": {
                    "start": 39,
                    "end": 39,
                    "start_line": 3,
                    "start_col": 0
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 52,
              "start_line": 1,
              "start_col": 6
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 52,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52,
    "start_line": 1,
    "start_col": 0
  }
}
