===source===
<?php $x = $value |> trim(...) |> strtolower(...);
===errors <=8.0===
'pipe operator (|>)' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'pipe operator (|>)' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
===errors 8.1-8.4===
'pipe operator (|>)' requires PHP 8.5 or higher
'pipe operator (|>)' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '>' in Standard input code on line 1
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ">" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "value"
                            },
                            "span": {
                              "start": 11,
                              "end": 17
                            }
                          },
                          "op": "Pipe",
                          "right": {
                            "kind": {
                              "CallableCreate": {
                                "kind": {
                                  "Function": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "trim"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 21,
                                          "end": 25
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 21,
                                      "end": 25
                                    }
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 21,
                              "end": 30
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 30
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "CallableCreate": {
                          "kind": {
                            "Function": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "strtolower"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 34,
                                    "end": 44
                                  }
                                }
                              },
                              "span": {
                                "start": 34,
                                "end": 44
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 49
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 49
          }
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
