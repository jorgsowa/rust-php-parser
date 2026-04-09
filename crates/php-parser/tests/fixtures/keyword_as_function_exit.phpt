===source===
<?php function exit(string|int $status = 0): never {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "exit",
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
                            "start": 20,
                            "end": 26,
                            "start_line": 1,
                            "start_col": 20
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 26,
                        "start_line": 1,
                        "start_col": 20
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
                            "start": 27,
                            "end": 30,
                            "start_line": 1,
                            "start_col": 27
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 30,
                        "start_line": 1,
                        "start_col": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 20,
                  "end": 30,
                  "start_line": 1,
                  "start_col": 20
                }
              },
              "default": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 41,
                  "end": 42,
                  "start_line": 1,
                  "start_col": 41
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
                "start": 20,
                "end": 42,
                "start_line": 1,
                "start_col": 20
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
                  "start": 45,
                  "end": 50,
                  "start_line": 1,
                  "start_col": 45
                }
              }
            },
            "span": {
              "start": 45,
              "end": 50,
              "start_line": 1,
              "start_col": 45
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
