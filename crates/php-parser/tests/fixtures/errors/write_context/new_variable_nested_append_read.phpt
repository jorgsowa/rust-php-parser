===source===
<?php $x = new $a->b[0][];
===errors===
Cannot use [] for reading
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 1
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
                  "New": {
                    "class": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "PropertyAccess": {
                                      "object": {
                                        "kind": {
                                          "Variable": "a"
                                        },
                                        "span": {
                                          "start": 15,
                                          "end": 17
                                        }
                                      },
                                      "property": {
                                        "kind": {
                                          "Identifier": "b"
                                        },
                                        "span": {
                                          "start": 19,
                                          "end": 20
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 15,
                                    "end": 20
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 21,
                                    "end": 22
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 15,
                              "end": 23
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 25
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 25
                }
              }
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
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
