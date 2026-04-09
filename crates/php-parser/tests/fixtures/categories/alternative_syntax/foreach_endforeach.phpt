===source===
<?php foreach ($arr as $v): echo $v; endforeach;
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
          "key": null,
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 23,
              "end": 25,
              "start_line": 1,
              "start_col": 23
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
                          "Variable": "v"
                        },
                        "span": {
                          "start": 33,
                          "end": 35,
                          "start_line": 1,
                          "start_col": 33
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 28,
                    "end": 37,
                    "start_line": 1,
                    "start_col": 28
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 48,
              "start_line": 1,
              "start_col": 6
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48,
        "start_line": 1,
        "start_col": 6
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
