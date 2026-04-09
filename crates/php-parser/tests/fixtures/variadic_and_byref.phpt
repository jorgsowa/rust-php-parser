===source===
<?php
function variadic(int ...$args): int {
    return 0;
}
function byref(&$ref): void {
    $ref = 1;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "variadic",
          "params": [
            {
              "name": "args",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 24,
                      "end": 27,
                      "start_line": 2,
                      "start_col": 18
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 27,
                  "start_line": 2,
                  "start_col": 18
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 24,
                "end": 36,
                "start_line": 2,
                "start_col": 18
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 56,
                    "end": 57,
                    "start_line": 3,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 59,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "int"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 39,
                  "end": 42,
                  "start_line": 2,
                  "start_col": 33
                }
              }
            },
            "span": {
              "start": 39,
              "end": 42,
              "start_line": 2,
              "start_col": 33
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "byref",
          "params": [
            {
              "name": "ref",
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 76,
                "end": 81,
                "start_line": 5,
                "start_col": 15
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "ref"
                        },
                        "span": {
                          "start": 95,
                          "end": 99,
                          "start_line": 6,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 102,
                          "end": 103,
                          "start_line": 6,
                          "start_col": 11
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 95,
                    "end": 103,
                    "start_line": 6,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 95,
                "end": 105,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 84,
                  "end": 88,
                  "start_line": 5,
                  "start_col": 23
                }
              }
            },
            "span": {
              "start": 84,
              "end": 88,
              "start_line": 5,
              "start_col": 23
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 61,
        "end": 106,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 106,
    "start_line": 1,
    "start_col": 0
  }
}
