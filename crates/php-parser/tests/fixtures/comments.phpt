===source===
<?php
// line comment
$x = 1; /* block comment */ $y = 2; /** doc comment */ # hash comment
$z = 3;

/** @param int $a */
function add($a, $b) {
    // return the sum
    return $a + $b; /* always positive */
}

/**/
/* empty-ish block */
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
                  "start": 22,
                  "end": 24,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 27,
                  "end": 28,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 28,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 50,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 50,
                  "end": 52,
                  "start_line": 3,
                  "start_col": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 55,
                  "end": 56,
                  "start_line": 3,
                  "start_col": 33
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 56,
            "start_line": 3,
            "start_col": 28
          }
        }
      },
      "span": {
        "start": 50,
        "end": 92,
        "start_line": 3,
        "start_col": 28
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 92,
                  "end": 94,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 97,
                  "end": 98,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 92,
            "end": 98,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 92,
        "end": 122,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "add",
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
                "start": 135,
                "end": 137,
                "start_line": 7,
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
                "start": 139,
                "end": 141,
                "start_line": 7,
                "start_col": 17
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
                          "start": 178,
                          "end": 180,
                          "start_line": 9,
                          "start_col": 11
                        }
                      },
                      "op": "Add",
                      "right": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 183,
                          "end": 185,
                          "start_line": 9,
                          "start_col": 16
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 178,
                    "end": 185,
                    "start_line": 9,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 171,
                "end": 209,
                "start_line": 9,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/** @param int $a */",
            "span": {
              "start": 101,
              "end": 121,
              "start_line": 6,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 122,
        "end": 210,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 210,
    "start_line": 1,
    "start_col": 0
  }
}
