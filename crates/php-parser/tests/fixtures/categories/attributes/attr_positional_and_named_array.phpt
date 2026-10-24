===source===
<?php #[Route('/api', methods: ['GET', 'POST'])] function handler() {}
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 70
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "handler",
            "span": {
              "start": 58,
              "end": 65
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
                  "Route"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "/api"
                      },
                      "span": {
                        "start": 14,
                        "end": 20
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 20
                  }
                },
                {
                  "name": {
                    "parts": [
                      "methods"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 22,
                      "end": 29
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "String": "GET"
                                },
                                "span": {
                                  "start": 32,
                                  "end": 37
                                }
                              }
                            },
                            "span": {
                              "start": 32,
                              "end": 37
                            }
                          },
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "String": "POST"
                                },
                                "span": {
                                  "start": 39,
                                  "end": 45
                                }
                              }
                            },
                            "span": {
                              "start": 39,
                              "end": 45
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 31,
                        "end": 46
                      }
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 46
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 47
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
