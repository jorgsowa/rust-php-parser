===source===
<?php
if ($x > 1 {
    echo "hello";
}
===errors <=7.4===
expected expression, found 'echo'
expected '}', found 'echo'
missing closing ')'
expected expression, found '}'
===errors >=8.0===
expected expression, found 'echo'
expected '}', found 'echo'
Array and string offset access syntax with curly braces is no longer supported
missing closing ')'
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 10,
                    "end": 12
                  }
                },
                "op": "Greater",
                "right": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 15,
                          "end": 16
                        }
                      },
                      "index": {
                        "kind": "Error",
                        "span": {
                          "start": 23,
                          "end": 27
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 15,
                    "end": 18
                  }
                }
              }
            },
            "span": {
              "start": 10,
              "end": 18
            }
          },
          "then_branch": {
            "kind": {
              "Echo": [
                {
                  "kind": {
                    "String": "hello"
                  },
                  "span": {
                    "start": 28,
                    "end": 35
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 36
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 37,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
