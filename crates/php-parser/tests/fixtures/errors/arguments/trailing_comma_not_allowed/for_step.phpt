===source===
<?php
for ($i = 0; $i < 1; $i++,);
===errors===
expected expression, found ')'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 11,
                      "end": 13
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 17
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 19,
                      "end": 21
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 24,
                      "end": 25
                    }
                  }
                }
              },
              "span": {
                "start": 19,
                "end": 25
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 27,
                "end": 31
              }
            }
          ],
          "body": {
            "kind": "Nop",
            "span": {
              "start": 33,
              "end": 34
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
