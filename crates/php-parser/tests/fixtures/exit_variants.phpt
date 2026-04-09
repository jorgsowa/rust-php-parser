===source===
<?php exit; exit(); exit(0); die; die(); die('error');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 6,
            "end": 10,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12,
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
            "start": 12,
            "end": 18,
            "start_line": 1,
            "start_col": 12
          }
        }
      },
      "span": {
        "start": 12,
        "end": 20,
        "start_line": 1,
        "start_col": 12
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "Int": 0
              },
              "span": {
                "start": 25,
                "end": 26,
                "start_line": 1,
                "start_col": 25
              }
            }
          },
          "span": {
            "start": 20,
            "end": 27,
            "start_line": 1,
            "start_col": 20
          }
        }
      },
      "span": {
        "start": 20,
        "end": 29,
        "start_line": 1,
        "start_col": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 29,
            "end": 32,
            "start_line": 1,
            "start_col": 29
          }
        }
      },
      "span": {
        "start": 29,
        "end": 34,
        "start_line": 1,
        "start_col": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 34,
            "end": 39,
            "start_line": 1,
            "start_col": 34
          }
        }
      },
      "span": {
        "start": 34,
        "end": 41,
        "start_line": 1,
        "start_col": 34
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "String": "error"
              },
              "span": {
                "start": 45,
                "end": 52,
                "start_line": 1,
                "start_col": 45
              }
            }
          },
          "span": {
            "start": 41,
            "end": 53,
            "start_line": 1,
            "start_col": 41
          }
        }
      },
      "span": {
        "start": 41,
        "end": 54,
        "start_line": 1,
        "start_col": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54,
    "start_line": 1,
    "start_col": 0
  }
}
