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
                  "end": 13,
                  "start_line": 1,
                  "start_col": 8
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
                      "end": 20,
                      "start_line": 1,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 20,
                    "start_line": 1,
                    "start_col": 14
                  }
                },
                {
                  "name": "methods",
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
                              "end": 37,
                              "start_line": 1,
                              "start_col": 32
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 32,
                            "end": 37,
                            "start_line": 1,
                            "start_col": 32
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
                              "end": 45,
                              "start_line": 1,
                              "start_col": 39
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 39,
                            "end": 45,
                            "start_line": 1,
                            "start_col": 39
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 31,
                      "end": 46,
                      "start_line": 1,
                      "start_col": 31
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 22,
                    "end": 46,
                    "start_line": 1,
                    "start_col": 22
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 47,
                "start_line": 1,
                "start_col": 8
              }
            }
          ]
        }
      },
      "span": {
        "start": 49,
        "end": 70,
        "start_line": 1,
        "start_col": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70,
    "start_line": 1,
    "start_col": 0
  }
}
