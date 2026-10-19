===source===
<?php while (1) { while (1) { break 2 ?>x<?php } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 13,
              "end": 14
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "While": {
                      "condition": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 25,
                          "end": 26
                        }
                      },
                      "body": {
                        "kind": {
                          "Block": [
                            {
                              "kind": {
                                "Break": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 36,
                                    "end": 37
                                  }
                                }
                              },
                              "span": {
                                "start": 30,
                                "end": 37
                              }
                            },
                            {
                              "kind": {
                                "InlineHtml": "x"
                              },
                              "span": {
                                "start": 40,
                                "end": 41
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 28,
                          "end": 48
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 48
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 50
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
