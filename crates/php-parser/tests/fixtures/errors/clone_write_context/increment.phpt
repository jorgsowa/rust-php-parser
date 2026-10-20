===source===
<?php
(clone $a)->b++;
--(clone $a)[0];
===errors===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===php_error <=8.4===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Clone": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 13,
                                "end": 15
                              }
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 16
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "op": "PostIncrement"
            }
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
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreDecrement",
              "operand": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Clone": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 32,
                                "end": 34
                              }
                            }
                          },
                          "span": {
                            "start": 26,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 35
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 36,
                        "end": 37
                      }
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 38
          }
        }
      },
      "span": {
        "start": 23,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
