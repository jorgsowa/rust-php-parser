===source===
<?php

foo();
bar()
baz();
===errors===
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'baz' (T_STRING) in Standard input code on line 5
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected identifier "baz" in Standard input code on line 5
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
        "end": 13
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
                      "start": 14,
                      "end": 17
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 17
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 14,
            "end": 19
          }
        }
      },
      "span": {
        "start": 14,
        "end": 19
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
                      "start": 20,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 20,
            "end": 25
          }
        }
      },
      "span": {
        "start": 20,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
