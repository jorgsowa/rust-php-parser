===source===
<?php
foreach ($items $item) {
    echo $item;
}
===errors===
expected 'as', found variable
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
              "start_line": 2,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "item"
            },
            "span": {
              "start": 22,
              "end": 27,
              "start_line": 2,
              "start_col": 16
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
                          "Variable": "item"
                        },
                        "span": {
                          "start": 40,
                          "end": 45,
                          "start_line": 3,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 35,
                    "end": 47,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 29,
              "end": 48,
              "start_line": 2,
              "start_col": 23
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
