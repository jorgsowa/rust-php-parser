===source===
<?php function f(int|string|int): int {}
===errors===
expected variable, found ')'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [
            {
              "name": "<error>",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 17,
                            "end": 20,
                            "start_line": 1,
                            "start_col": 17
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 17
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 21,
                            "end": 27,
                            "start_line": 1,
                            "start_col": 21
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 21
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
                            "start": 28,
                            "end": 31,
                            "start_line": 1,
                            "start_col": 28
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 31,
                        "start_line": 1,
                        "start_col": 28
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 31,
                  "start_line": 1,
                  "start_col": 17
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 31,
                "start_line": 1,
                "start_col": 17
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "int"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 34,
                  "end": 37,
                  "start_line": 1,
                  "start_col": 34
                }
              }
            },
            "span": {
              "start": 34,
              "end": 37,
              "start_line": 1,
              "start_col": 34
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40,
    "start_line": 1,
    "start_col": 0
  }
}
