===source===
<?php function gen() { yield from [1, 2, 3]; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 35,
                                  "end": 36
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 35,
                                "end": 36
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 38,
                                  "end": 39
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 38,
                                "end": 39
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 3
                                },
                                "span": {
                                  "start": 41,
                                  "end": 42
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 41,
                                "end": 42
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 34,
                          "end": 43
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 43
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 44
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
