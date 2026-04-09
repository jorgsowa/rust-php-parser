===source===
<?php
$user = new App\Models\User();
App\Helpers\format($data);
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
                  "Variable": "user"
                },
                "span": {
                  "start": 6,
                  "end": 11,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "App\\Models\\User"
                      },
                      "span": {
                        "start": 18,
                        "end": 33,
                        "start_line": 2,
                        "start_col": 12
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 14,
                  "end": 35,
                  "start_line": 2,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "App\\Helpers\\format"
                },
                "span": {
                  "start": 37,
                  "end": 55,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "data"
                    },
                    "span": {
                      "start": 56,
                      "end": 61,
                      "start_line": 3,
                      "start_col": 19
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 56,
                    "end": 61,
                    "start_line": 3,
                    "start_col": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 37,
            "end": 62,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 37,
        "end": 63,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
