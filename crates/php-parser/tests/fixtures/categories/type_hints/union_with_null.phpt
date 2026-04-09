===source===
<?php function f(int|string|null $x) {}
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
                            "null"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 28,
                            "end": 32,
                            "start_line": 1,
                            "start_col": 28
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 32,
                        "start_line": 1,
                        "start_col": 28
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 32,
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
                "end": 35,
                "start_line": 1,
                "start_col": 17
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39,
    "start_line": 1,
    "start_col": 0
  }
}
