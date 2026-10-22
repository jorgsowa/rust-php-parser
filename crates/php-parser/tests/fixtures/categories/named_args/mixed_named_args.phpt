===source===
<?php foo(1, 2, name: 'test', other: true);
===errors <=7.4===
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
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 10,
                        "end": 11
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 11
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 14
                  }
                },
                {
                  "name": {
                    "parts": [
                      "name"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "test"
                      },
                      "span": {
                        "start": 22,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 28
                  }
                },
                {
                  "name": {
                    "parts": [
                      "other"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 30,
                      "end": 35
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 37,
                        "end": 41
                      }
                    }
                  },
                  "span": {
                    "start": 30,
                    "end": 41
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 42
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
