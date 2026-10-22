===source===
<?php htmlspecialchars(string: $str, flags: ENT_QUOTES, encoding: 'UTF-8');
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 1
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
                      "htmlspecialchars"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 23,
                      "end": 29
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "str"
                      },
                      "span": {
                        "start": 31,
                        "end": 35
                      }
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 35
                  }
                },
                {
                  "name": {
                    "parts": [
                      "flags"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 37,
                      "end": 42
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "ENT_QUOTES"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 44,
                            "end": 54
                          }
                        }
                      },
                      "span": {
                        "start": 44,
                        "end": 54
                      }
                    }
                  },
                  "span": {
                    "start": 37,
                    "end": 54
                  }
                },
                {
                  "name": {
                    "parts": [
                      "encoding"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 56,
                      "end": 64
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "UTF-8"
                      },
                      "span": {
                        "start": 66,
                        "end": 73
                      }
                    }
                  },
                  "span": {
                    "start": 56,
                    "end": 73
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 74
          }
        }
      },
      "span": {
        "start": 6,
        "end": 75
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 75
  }
}
