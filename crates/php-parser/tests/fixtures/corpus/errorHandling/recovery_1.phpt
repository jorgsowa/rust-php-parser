===source===
<?php

foo()
bar()
baz()
===errors===
expected ';' after expression
expected ';' after expression
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'bar' (T_STRING) in Standard input code on line 4
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected identifier "bar" in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 7,
                      "end": 10
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 10
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 12
          }
        }
      },
      "span": {
        "start": 7,
        "end": 12
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "bar"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 13,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 16
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 13,
            "end": 18
          }
        }
      },
      "span": {
        "start": 13,
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "baz"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 22
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 19,
            "end": 24
          }
        }
      },
      "span": {
        "start": 19,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
