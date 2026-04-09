===source===
<?php $x = #[Attr] function() { return 1; };
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 39,
                              "end": 40,
                              "start_line": 1,
                              "start_col": 39
                            }
                          }
                        },
                        "span": {
                          "start": 32,
                          "end": 42,
                          "start_line": 1,
                          "start_col": 32
                        }
                      }
                    ],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Attr"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 13,
                            "end": 17,
                            "start_line": 1,
                            "start_col": 13
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 13,
                          "end": 17,
                          "start_line": 1,
                          "start_col": 13
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 43,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 43,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}
