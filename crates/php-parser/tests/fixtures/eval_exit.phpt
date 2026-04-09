===source===
<?php eval('echo 1;'); exit; exit(1); die('fatal');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Eval": {
              "kind": {
                "String": "echo 1;"
              },
              "span": {
                "start": 11,
                "end": 20,
                "start_line": 1,
                "start_col": 11
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 23,
            "end": 27,
            "start_line": 1,
            "start_col": 23
          }
        }
      },
      "span": {
        "start": 23,
        "end": 29,
        "start_line": 1,
        "start_col": 23
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 34,
                "end": 35,
                "start_line": 1,
                "start_col": 34
              }
            }
          },
          "span": {
            "start": 29,
            "end": 36,
            "start_line": 1,
            "start_col": 29
          }
        }
      },
      "span": {
        "start": 29,
        "end": 38,
        "start_line": 1,
        "start_col": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "String": "fatal"
              },
              "span": {
                "start": 42,
                "end": 49,
                "start_line": 1,
                "start_col": 42
              }
            }
          },
          "span": {
            "start": 38,
            "end": 50,
            "start_line": 1,
            "start_col": 38
          }
        }
      },
      "span": {
        "start": 38,
        "end": 51,
        "start_line": 1,
        "start_col": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51,
    "start_line": 1,
    "start_col": 0
  }
}
