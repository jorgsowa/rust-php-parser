===source===
<?php
function foo(int $a, $b {
    return $a + $b;
}
===errors===
unclosed '')'' opened at 2:12
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "a",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 22,
                      "start_line": 2,
                      "start_col": 13
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 22,
                  "start_line": 2,
                  "start_col": 13
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
                "start": 19,
                "end": 25,
                "start_line": 2,
                "start_col": 13
              }
            },
            {
              "name": "b",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 27,
                "end": 29,
                "start_line": 2,
                "start_col": 21
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 43,
                          "end": 45,
                          "start_line": 3,
                          "start_col": 11
                        }
                      },
                      "op": "Add",
                      "right": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 48,
                          "end": 50,
                          "start_line": 3,
                          "start_col": 16
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 43,
                    "end": 50,
                    "start_line": 3,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 36,
                "end": 52,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53,
        "start_line": 2,
        "start_col": 0
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
