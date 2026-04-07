===source===
<?php list($a, list($b, $c)) = $arr;
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
                          "Variable": "a"
                        },
                        "span": {
                          "start": 11,
                          "end": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 13
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
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 20,
                                  "end": 22
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 20,
                                "end": 22
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 24,
                                  "end": 26
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 24,
                                "end": 26
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 15,
                          "end": 27
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 31,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
