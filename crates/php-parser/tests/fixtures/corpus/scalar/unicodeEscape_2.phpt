===source===
<?php

"\u{0}";
"\u{114}$foo";
`\u{1F602}$bar`;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "\u0000"
          },
          "span": {
            "start": 7,
            "end": 14,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 16,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Literal": "Ĕ"
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "foo"
                  },
                  "span": {
                    "start": 24,
                    "end": 28,
                    "start_line": 4,
                    "start_col": 8
                  }
                }
              }
            ]
          },
          "span": {
            "start": 16,
            "end": 29,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 16,
        "end": 31,
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
                "Literal": "😂"
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "bar"
                  },
                  "span": {
                    "start": 41,
                    "end": 45,
                    "start_line": 5,
                    "start_col": 10
                  }
                }
              }
            ]
          },
          "span": {
            "start": 31,
            "end": 46,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 31,
        "end": 47,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}
