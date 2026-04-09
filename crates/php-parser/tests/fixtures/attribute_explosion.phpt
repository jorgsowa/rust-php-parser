===source===
<?php
#[A] #[B] #[C]
function f(
    #[Attr1] #[Attr2] int $x,
    #[Attr3] string $y
): void {}
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
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 55,
                      "end": 58,
                      "start_line": 4,
                      "start_col": 22
                    }
                  }
                },
                "span": {
                  "start": 55,
                  "end": 58,
                  "start_line": 4,
                  "start_col": 22
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "Attr1"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 39,
                      "end": 44,
                      "start_line": 4,
                      "start_col": 6
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 39,
                    "end": 44,
                    "start_line": 4,
                    "start_col": 6
                  }
                },
                {
                  "name": {
                    "parts": [
                      "Attr2"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 48,
                      "end": 53,
                      "start_line": 4,
                      "start_col": 15
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 48,
                    "end": 53,
                    "start_line": 4,
                    "start_col": 15
                  }
                }
              ],
              "span": {
                "start": 37,
                "end": 61,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "name": "y",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 76,
                      "end": 82,
                      "start_line": 5,
                      "start_col": 13
                    }
                  }
                },
                "span": {
                  "start": 76,
                  "end": 82,
                  "start_line": 5,
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
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "Attr3"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 69,
                      "end": 74,
                      "start_line": 5,
                      "start_col": 6
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 69,
                    "end": 74,
                    "start_line": 5,
                    "start_col": 6
                  }
                }
              ],
              "span": {
                "start": 67,
                "end": 85,
                "start_line": 5,
                "start_col": 4
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
                  "start": 89,
                  "end": 93,
                  "start_line": 6,
                  "start_col": 3
                }
              }
            },
            "span": {
              "start": 89,
              "end": 93,
              "start_line": 6,
              "start_col": 3
            }
          },
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 9,
                  "start_line": 2,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 9,
                "start_line": 2,
                "start_col": 2
              }
            },
            {
              "name": {
                "parts": [
                  "B"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 13,
                  "end": 14,
                  "start_line": 2,
                  "start_col": 7
                }
              },
              "args": [],
              "span": {
                "start": 13,
                "end": 14,
                "start_line": 2,
                "start_col": 7
              }
            },
            {
              "name": {
                "parts": [
                  "C"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 18,
                  "end": 19,
                  "start_line": 2,
                  "start_col": 12
                }
              },
              "args": [],
              "span": {
                "start": 18,
                "end": 19,
                "start_line": 2,
                "start_col": 12
              }
            }
          ]
        }
      },
      "span": {
        "start": 21,
        "end": 96,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96,
    "start_line": 1,
    "start_col": 0
  }
}
