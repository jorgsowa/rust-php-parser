===source===
<?php (void)[1, 2, 3];
===errors <=8.4===
expected ']', found ','
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',', expecting ']' in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ",", expecting "]" in Standard input code on line 1
===ast <=8.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 11
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "index": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 13,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 14,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
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
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 17
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 19,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 12,
                  "end": 21
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
