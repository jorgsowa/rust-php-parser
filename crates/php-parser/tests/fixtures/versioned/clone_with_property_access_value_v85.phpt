===config===
min_php=8.5
===source===
<?php $b = clone($obj, ['prop' => $other->prop]);
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
                  "Variable": "b"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CloneWith": [
                    {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 17,
                        "end": 21
                      }
                    },
                    {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "prop"
                              },
                              "span": {
                                "start": 24,
                                "end": 30
                              }
                            },
                            "value": {
                              "kind": {
                                "PropertyAccess": {
                                  "object": {
                                    "kind": {
                                      "Variable": "other"
                                    },
                                    "span": {
                                      "start": 34,
                                      "end": 40
                                    }
                                  },
                                  "property": {
                                    "kind": {
                                      "Identifier": "prop"
                                    },
                                    "span": {
                                      "start": 42,
                                      "end": 46
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 34,
                                "end": 46
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 24,
                              "end": 46
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 23,
                        "end": 47
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 48
          }
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
