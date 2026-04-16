===source===
<?php #[Route('/api', methods: ['GET', 'POST'])] function handler() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "handler",
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
                  "value": {
                    "kind": {
                      "String": "/api"
                    },
                    "span": {
                      "start": 14,
                      "end": 20
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
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
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "String": "GET"
                            },
                            "span": {
                              "start": 32,
                              "end": 37
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 32,
                            "end": 37
                          }
                        },
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "String": "POST"
                            },
                            "span": {
                              "start": 39,
                              "end": 45
                            }
                          },
                          "unpack": false,
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
                  },
                  "unpack": false,
                  "by_ref": false,
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
        "start": 49,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
