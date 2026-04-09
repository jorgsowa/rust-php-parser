===source===
<?php function die(string|int $status = 0): never {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "die",
          "params": [
            {
              "name": "status",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 25,
                            "start_line": 1,
                            "start_col": 19
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 25,
                        "start_line": 1,
                        "start_col": 19
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 26,
                            "end": 29,
                            "start_line": 1,
                            "start_col": 26
                          }
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 29,
                        "start_line": 1,
                        "start_col": 26
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 29,
                  "start_line": 1,
                  "start_col": 19
                }
              },
              "default": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 40,
                  "end": 41,
                  "start_line": 1,
                  "start_col": 40
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 41,
                "start_line": 1,
                "start_col": 19
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 44,
                  "end": 49,
                  "start_line": 1,
                  "start_col": 44
                }
              }
            },
            "span": {
              "start": 44,
              "end": 49,
              "start_line": 1,
              "start_col": 44
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52,
    "start_line": 1,
    "start_col": 0
  }
}
