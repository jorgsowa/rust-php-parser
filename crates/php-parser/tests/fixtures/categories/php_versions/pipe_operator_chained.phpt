===source===
<?php $x |> strlen(...) |> abs(...);
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
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 6,
                        "end": 8
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
                                    "strlen"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 12,
                                    "end": 18
                                  }
                                }
                              },
                              "span": {
                                "start": 12,
                                "end": 18
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 23
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
                              "abs"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 27,
                              "end": 30
                            }
                          }
                        },
                        "span": {
                          "start": 27,
                          "end": 30
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
