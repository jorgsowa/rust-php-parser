===source===
<?php
`\\\\`;
`\\\$`;
`\\\``;
`\\$var`;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "\\\\"
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "\\$"
              }
            ]
          },
          "span": {
            "start": 14,
            "end": 20
          }
        }
      },
      "span": {
        "start": 14,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "\\\\`"
              }
            ]
          },
          "span": {
            "start": 22,
            "end": 28
          }
        }
      },
      "span": {
        "start": 22,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "\\"
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "var"
                  },
                  "span": {
                    "start": 33,
                    "end": 37
                  }
                }
              }
            ]
          },
          "span": {
            "start": 30,
            "end": 38
          }
        }
      },
      "span": {
        "start": 30,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
