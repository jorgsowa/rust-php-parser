===source===
<?php #[Route(path: '/api', methods: ['GET'])] function handler() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "handler",
            "span": {
              "start": 56,
              "end": 63
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
                  "name": {
                    "parts": [
                      "path"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 14,
                      "end": 18
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "/api"
                      },
                      "span": {
                        "start": 20,
                        "end": 26
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 26
                  }
                },
                {
                  "name": {
                    "parts": [
                      "methods"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 28,
                      "end": 35
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
                                  "start": 38,
                                  "end": 43
                                }
                              }
                            },
                            "span": {
                              "start": 38,
                              "end": 43
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 37,
                        "end": 44
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 44
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 45
              }
            }
          ]
        }
      },
      "span": {
        "start": 47,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
