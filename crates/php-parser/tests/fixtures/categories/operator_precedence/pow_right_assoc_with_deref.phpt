===description===
PHP: `2 ** $a->b ** $c->d` is `2 ** (($a->b) ** ($c->d))`. `**` is right-associative and each operand keeps its member access.
===source===
<?php
2 ** $a->b ** $c->d;
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
                  "Int": 2
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 11,
                              "end": 13
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 15,
                              "end": 16
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 16
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 20,
                              "end": 22
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "d"
                            },
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 25
                      }
                    }
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
