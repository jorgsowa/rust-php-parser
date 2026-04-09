===config===
min_php=8.1
===source===
<?php $val = Fiber::suspend(42);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "val"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Identifier": "Fiber"
                      },
                      "span": {
                        "start": 13,
                        "end": 18,
                        "start_line": 1,
                        "start_col": 13
                      }
                    },
                    "method": "suspend",
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 42
                          },
                          "span": {
                            "start": 28,
                            "end": 30,
                            "start_line": 1,
                            "start_col": 28
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 28,
                          "end": 30,
                          "start_line": 1,
                          "start_col": 28
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 13,
                  "end": 31,
                  "start_line": 1,
                  "start_col": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32,
    "start_line": 1,
    "start_col": 0
  }
}
