===source===
<?php
function process(?string $name, ?int $count, ?array $items): ?bool {
    return null;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "process",
          "params": [
            {
              "name": "name",
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
                          "start": 24,
                          "end": 30,
                          "start_line": 2,
                          "start_col": 18
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 30,
                      "start_line": 2,
                      "start_col": 18
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 30,
                  "start_line": 2,
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
                "start": 23,
                "end": 36,
                "start_line": 2,
                "start_col": 17
              }
            },
            {
              "name": "count",
              "type_hint": {
                "kind": {
                  "Nullable": {
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
                  }
                },
                "span": {
                  "start": 38,
                  "end": 42,
                  "start_line": 2,
                  "start_col": 32
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
                "start": 38,
                "end": 49,
                "start_line": 2,
                "start_col": 32
              }
            },
            {
              "name": "items",
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 52,
                          "end": 57,
                          "start_line": 2,
                          "start_col": 46
                        }
                      }
                    },
                    "span": {
                      "start": 52,
                      "end": 57,
                      "start_line": 2,
                      "start_col": 46
                    }
                  }
                },
                "span": {
                  "start": 51,
                  "end": 57,
                  "start_line": 2,
                  "start_col": 45
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
                "start": 51,
                "end": 64,
                "start_line": 2,
                "start_col": 45
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 86,
                    "end": 90,
                    "start_line": 3,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 79,
                "end": 92,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "bool"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 68,
                      "end": 72,
                      "start_line": 2,
                      "start_col": 62
                    }
                  }
                },
                "span": {
                  "start": 68,
                  "end": 72,
                  "start_line": 2,
                  "start_col": 62
                }
              }
            },
            "span": {
              "start": 67,
              "end": 72,
              "start_line": 2,
              "start_col": 61
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 93,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93,
    "start_line": 1,
    "start_col": 0
  }
}
