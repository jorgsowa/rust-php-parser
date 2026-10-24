===source===
<?php
foo((int) $a, (string)(bool) $b);
clone (object) $c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Cast": [
                          "Int",
                          {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 16,
                              "end": 18
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 10,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 18
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Cast": [
                          "String",
                          {
                            "kind": {
                              "Cast": [
                                "Bool",
                                {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 35,
                                    "end": 37
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 28,
                              "end": 37
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 20,
                        "end": 37
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 37
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 38
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "Cast": [
                  "Object",
                  {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 55,
                      "end": 57
                    }
                  }
                ]
              },
              "span": {
                "start": 46,
                "end": 57
              }
            }
          },
          "span": {
            "start": 40,
            "end": 57
          }
        }
      },
      "span": {
        "start": 40,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
