===source===
<?php
f(...)->b = 1;
$o->m(...)[0] = 1;
===errors===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===php_error===
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "CallableCreate": {
                          "kind": {
                            "Function": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "f"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 6,
                                    "end": 7
                                  }
                                }
                              },
                              "span": {
                                "start": 6,
                                "end": 7
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 12
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 14,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
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
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "CallableCreate": {
                          "kind": {
                            "Method": {
                              "object": {
                                "kind": {
                                  "Variable": "o"
                                },
                                "span": {
                                  "start": 21,
                                  "end": 23
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "m"
                                },
                                "span": {
                                  "start": 25,
                                  "end": 26
                                }
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 31
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 32,
                        "end": 33
                      }
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 34
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 37,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 38
          }
        }
      },
      "span": {
        "start": 21,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
