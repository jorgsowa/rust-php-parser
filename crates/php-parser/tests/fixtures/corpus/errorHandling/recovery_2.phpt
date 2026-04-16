===source===
<?php

foo()
bar();
baz();
===errors===
expected ';' after expression
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
                  "Identifier": "foo"
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
                  "Identifier": "bar"
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
                  "Identifier": "baz"
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
===php_error===
PHP Parse error:  syntax error, unexpected identifier "bar" in Standard input code on line 4
