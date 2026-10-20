===source===
<?php $x |> strlen(...) |> abs(...);
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token ">" in Standard input code on line 1
===ast >=8.5===
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
