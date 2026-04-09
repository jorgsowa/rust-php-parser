===source===
<?php function foo(Countable&Traversable $x) {}
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
                            "Countable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 28,
                            "start_line": 1,
                            "start_col": 19
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 28,
                        "start_line": 1,
                        "start_col": 19
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
                            "start": 29,
                            "end": 41,
                            "start_line": 1,
                            "start_col": 29
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 41,
                        "start_line": 1,
                        "start_col": 29
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 41,
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
                "end": 43,
                "start_line": 1,
                "start_col": 19
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
        "end": 47,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}
