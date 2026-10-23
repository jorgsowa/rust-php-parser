===source===
<?php cl[p1$x{`
===errors <=7.4===
unterminated string literal
expected ']', found variable
expected '}', found end of file
===errors >=8.0===
unterminated string literal
expected ']', found variable
expected '}', found end of file
Array and string offset access syntax with curly braces is no longer supported
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '$x' (T_VARIABLE), expecting ']' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected variable "$x", expecting "]" in Standard input code on line 1
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
                  "Name": {
                    "parts": [
                      "cl"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 8
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "index": {
                "kind": {
                  "Name": {
                    "parts": [
                      "p1"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 9,
                      "end": 11
                    }
                  }
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
