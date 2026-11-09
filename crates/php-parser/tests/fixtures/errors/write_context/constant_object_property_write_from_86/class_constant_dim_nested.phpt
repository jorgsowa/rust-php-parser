===source===
<?php
E::A[0]->p->q = 1;
===errors <=8.5===
Cannot use temporary expression in write context
===php_error <=8.5===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
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
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "ClassConstAccess": {
                                      "class": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "E"
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
                                      },
                                      "member": {
                                        "kind": {
                                          "Identifier": "A"
                                        },
                                        "span": {
                                          "start": 9,
                                          "end": 10
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 6,
                                    "end": 10
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 11,
                                    "end": 12
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 6,
                              "end": 13
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "p"
                            },
                            "span": {
                              "start": 15,
                              "end": 16
                            }
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
                        "Identifier": "q"
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
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 22,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
