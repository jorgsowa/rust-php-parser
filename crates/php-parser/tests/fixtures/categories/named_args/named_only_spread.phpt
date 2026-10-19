===source===
<?php foo(...['name' => $x]);
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
                    "Spread": {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "name"
                              },
                              "span": {
                                "start": 14,
                                "end": 20
                              }
                            },
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 24,
                                  "end": 26
                                }
                              }
                            },
                            "span": {
                              "start": 14,
                              "end": 26
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 13,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 27
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
