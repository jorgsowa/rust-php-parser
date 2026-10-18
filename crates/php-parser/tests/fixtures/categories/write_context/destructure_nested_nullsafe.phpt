===source===
<?php [$x, [$a?->b]] = $c;
===errors===
Assignments can only happen to writable values
===php_error===
PHP Fatal error:  Assignments can only happen to writable values in Standard input code on line 1
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 7,
                          "end": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "NullsafePropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 12,
                                        "end": 14
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "b"
                                      },
                                      "span": {
                                        "start": 17,
                                        "end": 18
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 12,
                                  "end": 18
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 12,
                                "end": 18
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 11,
                          "end": 19
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 20
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 23,
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
