===source===
<?php function f(Countable&Traversable&ArrayAccess $x): void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Countable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 17,
                            "end": 26,
                            "start_line": 1,
                            "start_col": 17
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 26,
                        "start_line": 1,
                        "start_col": 17
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Traversable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 27,
                            "end": 38,
                            "start_line": 1,
                            "start_col": 27
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 38,
                        "start_line": 1,
                        "start_col": 27
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "ArrayAccess"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 39,
                            "end": 51,
                            "start_line": 1,
                            "start_col": 39
                          }
                        }
                      },
                      "span": {
                        "start": 39,
                        "end": 51,
                        "start_line": 1,
                        "start_col": 39
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 51,
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
                "end": 53,
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
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 56,
                  "end": 60,
                  "start_line": 1,
                  "start_col": 56
                }
              }
            },
            "span": {
              "start": 56,
              "end": 60,
              "start_line": 1,
              "start_col": 56
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
