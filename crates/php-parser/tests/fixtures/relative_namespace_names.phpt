===source===
<?php
namespace App\Services;
$obj = new namespace\MyClass();
namespace\helper_func();
echo namespace\SOME_CONST;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "App",
              "Services"
            ],
            "kind": "Qualified",
            "span": {
              "start": 16,
              "end": 28,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 30,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 30,
                  "end": 34,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "MyClass"
                      },
                      "span": {
                        "start": 41,
                        "end": 58,
                        "start_line": 3,
                        "start_col": 11
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 37,
                  "end": 60,
                  "start_line": 3,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 60,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 30,
        "end": 62,
        "start_line": 3,
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
                  "Identifier": "namespace\\helper_func"
                },
                "span": {
                  "start": 62,
                  "end": 83,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 62,
            "end": 85,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 62,
        "end": 87,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Identifier": "namespace\\SOME_CONST"
            },
            "span": {
              "start": 92,
              "end": 112,
              "start_line": 5,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 87,
        "end": 113,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113,
    "start_line": 1,
    "start_col": 0
  }
}
