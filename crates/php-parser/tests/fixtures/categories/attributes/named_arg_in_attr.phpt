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
                  "end": 13,
                  "start_line": 1,
                  "start_col": 8
                }
              },
              "args": [
                {
                  "name": "path",
                  "value": {
                    "kind": {
                      "String": "/api"
                    },
                    "span": {
                      "start": 20,
                      "end": 26,
                      "start_line": 1,
                      "start_col": 20
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 26,
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
                              "start": 38,
                              "end": 43,
                              "start_line": 1,
                              "start_col": 38
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 38,
                            "end": 43,
                            "start_line": 1,
                            "start_col": 38
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 37,
                      "end": 44,
                      "start_line": 1,
                      "start_col": 37
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 28,
                    "end": 44,
                    "start_line": 1,
                    "start_col": 28
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 45,
                "start_line": 1,
                "start_col": 8
              }
            }
          ]
        }
      },
      "span": {
        "start": 47,
        "end": 68,
        "start_line": 1,
        "start_col": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68,
    "start_line": 1,
    "start_col": 0
  }
}
