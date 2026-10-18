===source===
<?php $fn = function() use (&$a, &$b) { return $a + $b; };
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 29,
                            "end": 31
                          }
                        },
                        "by_ref": true,
                        "span": {
                          "start": 28,
                          "end": 31
                        }
                      },
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 34,
                            "end": 36
                          }
                        },
                        "by_ref": true,
                        "span": {
                          "start": 33,
                          "end": 36
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 47,
                                    "end": 49
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 52,
                                    "end": 54
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 47,
                              "end": 54
                            }
                          }
                        },
                        "span": {
                          "start": 40,
                          "end": 55
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 57
          }
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
