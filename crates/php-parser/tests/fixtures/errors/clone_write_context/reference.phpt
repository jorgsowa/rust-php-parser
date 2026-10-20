===source===
<?php
$r = &(clone $a)->b;
$r = &(clone $a)[0];
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
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
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
                                "start": 19,
                                "end": 21
                              }
                            }
                          },
                          "span": {
                            "start": 13,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 22
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 25
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r"
                },
                "span": {
                  "start": 27,
                  "end": 29
                }
              },
              "op": "Assign",
              "value": {
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
                                "start": 40,
                                "end": 42
                              }
                            }
                          },
                          "span": {
                            "start": 34,
                            "end": 42
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 43
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 44,
                        "end": 45
                      }
                    }
                  }
                },
                "span": {
                  "start": 33,
                  "end": 46
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 27,
            "end": 46
          }
        }
      },
      "span": {
        "start": 27,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
