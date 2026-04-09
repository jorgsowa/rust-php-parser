===source===
<?php

foreach ($foo) { $bar; }
foreach ($foo as ) { $bar; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "foo"
            },
            "span": {
              "start": 16,
              "end": 20,
              "start_line": 3,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": "Error",
            "span": {
              "start": 20,
              "end": 21,
              "start_line": 3,
              "start_col": 13
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Variable": "bar"
                      },
                      "span": {
                        "start": 24,
                        "end": 28,
                        "start_line": 3,
                        "start_col": 17
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 30,
                    "start_line": 3,
                    "start_col": 17
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 31,
              "start_line": 3,
              "start_col": 15
            }
          }
        }
      },
      "span": {
        "start": 7,
        "end": 31,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "foo"
            },
            "span": {
              "start": 41,
              "end": 45,
              "start_line": 4,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": "Error",
            "span": {
              "start": 49,
              "end": 50,
              "start_line": 4,
              "start_col": 17
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Variable": "bar"
                      },
                      "span": {
                        "start": 53,
                        "end": 57,
                        "start_line": 4,
                        "start_col": 21
                      }
                    }
                  },
                  "span": {
                    "start": 53,
                    "end": 59,
                    "start_line": 4,
                    "start_col": 21
                  }
                }
              ]
            },
            "span": {
              "start": 51,
              "end": 60,
              "start_line": 4,
              "start_col": 19
            }
          }
        }
      },
      "span": {
        "start": 32,
        "end": 60,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60,
    "start_line": 1,
    "start_col": 0
  }
}
