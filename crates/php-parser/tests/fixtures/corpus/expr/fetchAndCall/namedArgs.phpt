===source===
<?php
foo(a: $b, c: $d);
bar(class: 0);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 2
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
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "a"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 11
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 13,
                        "end": 15
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 15
                  }
                },
                {
                  "name": {
                    "parts": [
                      "c"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 18
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 20,
                        "end": 22
                      }
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 22
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
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
                      "start": 25,
                      "end": 28
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 28
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "class"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 36,
                        "end": 37
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 37
                  }
                }
              ]
            }
          },
          "span": {
            "start": 25,
            "end": 38
          }
        }
      },
      "span": {
        "start": 25,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
