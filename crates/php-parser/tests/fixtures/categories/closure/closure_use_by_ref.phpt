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
                        "name": "a",
                        "by_ref": true,
                        "span": {
                          "start": 28,
                          "end": 31
                        }
                      },
                      {
                        "name": "b",
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
                          "end": 56
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
