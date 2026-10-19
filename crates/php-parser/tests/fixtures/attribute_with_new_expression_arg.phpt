===source===
<?php #[Attr(new Config(debug: false))] function f() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 49,
              "end": 50
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 12
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Config"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 17,
                                  "end": 23
                                }
                              }
                            },
                            "span": {
                              "start": 17,
                              "end": 23
                            }
                          },
                          "args": [
                            {
                              "name": {
                                "parts": [
                                  "debug"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 24,
                                  "end": 29
                                }
                              },
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Bool": false
                                  },
                                  "span": {
                                    "start": 31,
                                    "end": 36
                                  }
                                }
                              },
                              "span": {
                                "start": 24,
                                "end": 36
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 37
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 37
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 38
              }
            }
          ]
        }
      },
      "span": {
        "start": 40,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
