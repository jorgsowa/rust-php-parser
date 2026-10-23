===source===
<?php

foreach ($foo) { $bar; }
foreach ($foo as ) { $bar; }
===errors===
expected 'as', found ')'
expected expression, found ')'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "foo"
            },
            "span": {
              "start": 16,
              "end": 20
            }
          },
          "key": null,
          "value": {
            "kind": "Error",
            "span": {
              "start": 20,
              "end": 20
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Variable": "bar"
                      },
                      "span": {
                        "start": 24,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 29
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 31
            }
          }
        }
      },
      "span": {
        "start": 7,
        "end": 31
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "foo"
            },
            "span": {
              "start": 41,
              "end": 45
            }
          },
          "key": null,
          "value": {
            "kind": "Error",
            "span": {
              "start": 48,
              "end": 48
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Variable": "bar"
                      },
                      "span": {
                        "start": 53,
                        "end": 57
                      }
                    }
                  },
                  "span": {
                    "start": 53,
                    "end": 58
                  }
                }
              ]
            },
            "span": {
              "start": 51,
              "end": 60
            }
          }
        }
      },
      "span": {
        "start": 32,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
