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
            "end": 8
          }
        }
      },
      "span": {
        "start": 6,
        "end": 9
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
            "end": 16
          }
        }
      },
      "span": {
        "start": 10,
        "end": 17
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
                    "end": 26
                  }
                }
              }
            ]
          },
          "span": {
            "start": 18,
            "end": 27
          }
        }
      },
      "span": {
        "start": 18,
        "end": 28
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
            "end": 38
          }
        }
      },
      "span": {
        "start": 29,
        "end": 39
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
            "end": 49
          }
        }
      },
      "span": {
        "start": 40,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
