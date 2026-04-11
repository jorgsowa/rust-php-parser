===source===
<?php cl[p1$x{`
===errors===
unterminated string literal
expected ']', found variable
expected ';' after expression
expected '}', found end of file
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Identifier": "cl"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "index": {
                "kind": {
                  "Identifier": "p1"
                },
                "span": {
                  "start": 9,
                  "end": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 11,
                  "end": 13
                }
              },
              "index": {
                "kind": {
                  "ShellExec": [
                    {
                      "Literal": ""
                    }
                  ]
                },
                "span": {
                  "start": 14,
                  "end": 15
                }
              }
            }
          },
          "span": {
            "start": 11,
            "end": 15
          }
        }
      },
      "span": {
        "start": 11,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
