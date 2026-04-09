===source===
<?php
``;
`test`;
`test $A`;
`test \``;
`test \"`;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": ""
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 8,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "test"
              }
            ]
          },
          "span": {
            "start": 10,
            "end": 16,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 10,
        "end": 18,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "test "
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 24,
                    "end": 26,
                    "start_line": 4,
                    "start_col": 6
                  }
                }
              }
            ]
          },
          "span": {
            "start": 18,
            "end": 27,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 18,
        "end": 29,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "test \\`"
              }
            ]
          },
          "span": {
            "start": 29,
            "end": 38,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 29,
        "end": 40,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "test \""
              }
            ]
          },
          "span": {
            "start": 40,
            "end": 49,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 40,
        "end": 50,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50,
    "start_line": 1,
    "start_col": 0
  }
}
