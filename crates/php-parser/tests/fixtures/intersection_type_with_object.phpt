===source===
<?php function foo(Iterator&Countable $x): void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
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
                            "Iterator"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 27,
                            "start_line": 1,
                            "start_col": 19
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 19
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Countable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 28,
                            "end": 38,
                            "start_line": 1,
                            "start_col": 28
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 38,
                        "start_line": 1,
                        "start_col": 28
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 38,
                  "start_line": 1,
                  "start_col": 19
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
                "end": 40,
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
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 43,
                  "end": 47,
                  "start_line": 1,
                  "start_col": 43
                }
              }
            },
            "span": {
              "start": 43,
              "end": 47,
              "start_line": 1,
              "start_col": 43
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50,
    "start_line": 1,
    "start_col": 0
  }
}
