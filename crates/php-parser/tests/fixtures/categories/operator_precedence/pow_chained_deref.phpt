===description===
PHP: `10 ** $this->a->b[0]->c()` keeps the entire dereference chain as the `**` right operand.
===source===
<?php
10 ** $this->a->b[0]->c();
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
                  "Int": 10
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "PropertyAccess": {
                                "object": {
                                  "kind": {
                                    "PropertyAccess": {
                                      "object": {
                                        "kind": {
                                          "Variable": "this"
                                        },
                                        "span": {
                                          "start": 12,
                                          "end": 17
                                        }
                                      },
                                      "property": {
                                        "kind": {
                                          "Identifier": "a"
                                        },
                                        "span": {
                                          "start": 19,
                                          "end": 20
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 12,
                                    "end": 20
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "b"
                                  },
                                  "span": {
                                    "start": 22,
                                    "end": 23
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 12,
                              "end": 23
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
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
                        "end": 26
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 28,
                        "end": 29
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
