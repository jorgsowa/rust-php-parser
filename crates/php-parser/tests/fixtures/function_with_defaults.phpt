===source===
<?php function foo($a, $b = 10, $c = 'x') { return $a + $b; }
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
                "start": 19,
                "end": 21,
                "start_line": 1,
                "start_col": 19
              }
            },
            {
              "name": "b",
              "type_hint": null,
              "default": {
                "kind": {
                  "Int": 10
                },
                "span": {
                  "start": 28,
                  "end": 30,
                  "start_line": 1,
                  "start_col": 28
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
                "start": 23,
                "end": 30,
                "start_line": 1,
                "start_col": 23
              }
            },
            {
              "name": "c",
              "type_hint": null,
              "default": {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 37,
                  "end": 40,
                  "start_line": 1,
                  "start_col": 37
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
                "start": 32,
                "end": 40,
                "start_line": 1,
                "start_col": 32
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
                          "start": 51,
                          "end": 53,
                          "start_line": 1,
                          "start_col": 51
                        }
                      },
                      "op": "Add",
                      "right": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 56,
                          "end": 58,
                          "start_line": 1,
                          "start_col": 56
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 51,
                    "end": 58,
                    "start_line": 1,
                    "start_col": 51
                  }
                }
              },
              "span": {
                "start": 44,
                "end": 60,
                "start_line": 1,
                "start_col": 44
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
        "end": 61,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61,
    "start_line": 1,
    "start_col": 0
  }
}
