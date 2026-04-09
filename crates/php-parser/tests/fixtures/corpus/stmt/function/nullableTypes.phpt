===source===
<?php

function test(?Foo $bar, ?string $foo) : ?Baz {
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [
            {
              "name": "bar",
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 26,
                          "start_line": 3,
                          "start_col": 15
                        }
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 26,
                      "start_line": 3,
                      "start_col": 15
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 26,
                  "start_line": 3,
                  "start_col": 14
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
                "start": 21,
                "end": 30,
                "start_line": 3,
                "start_col": 14
              }
            },
            {
              "name": "foo",
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 39,
                          "start_line": 3,
                          "start_col": 26
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 39,
                      "start_line": 3,
                      "start_col": 26
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 39,
                  "start_line": 3,
                  "start_col": 25
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
                "start": 32,
                "end": 44,
                "start_line": 3,
                "start_col": 25
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Baz"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 49,
                      "end": 53,
                      "start_line": 3,
                      "start_col": 42
                    }
                  }
                },
                "span": {
                  "start": 49,
                  "end": 53,
                  "start_line": 3,
                  "start_col": 42
                }
              }
            },
            "span": {
              "start": 48,
              "end": 53,
              "start_line": 3,
              "start_col": 41
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 56,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56,
    "start_line": 1,
    "start_col": 0
  }
}
