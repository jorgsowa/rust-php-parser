===source===
<?php #[Route(path: '/api', methods: ['GET'])] function handler() {}
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
                  "value": {
                    "kind": {
                      "String": "/api"
                    },
                    "span": {
                      "start": 20,
                      "end": 26
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
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
                              "start": 38,
                              "end": 43
                            }
                          },
                          "unpack": false,
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
                  },
                  "unpack": false,
                  "by_ref": false,
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
