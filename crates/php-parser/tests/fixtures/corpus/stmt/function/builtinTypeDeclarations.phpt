===source===
<?php
function test(bool $a, Int $b, FLOAT $c, StRiNg $d, iterable $e, object $f, mixed $g) : void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [
            {
              "name": "a",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "bool"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 20,
                      "end": 24,
                      "start_line": 2,
                      "start_col": 14
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 24,
                  "start_line": 2,
                  "start_col": 14
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
                "start": 20,
                "end": 27,
                "start_line": 2,
                "start_col": 14
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 29,
                      "end": 32,
                      "start_line": 2,
                      "start_col": 23
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 32,
                  "start_line": 2,
                  "start_col": 23
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
                "start": 29,
                "end": 35,
                "start_line": 2,
                "start_col": 23
              }
            },
            {
              "name": "c",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "float"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 37,
                      "end": 42,
                      "start_line": 2,
                      "start_col": 31
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 42,
                  "start_line": 2,
                  "start_col": 31
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
                "start": 37,
                "end": 45,
                "start_line": 2,
                "start_col": 31
              }
            },
            {
              "name": "d",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 47,
                      "end": 53,
                      "start_line": 2,
                      "start_col": 41
                    }
                  }
                },
                "span": {
                  "start": 47,
                  "end": 53,
                  "start_line": 2,
                  "start_col": 41
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
                "start": 47,
                "end": 56,
                "start_line": 2,
                "start_col": 41
              }
            },
            {
              "name": "e",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "iterable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 58,
                      "end": 66,
                      "start_line": 2,
                      "start_col": 52
                    }
                  }
                },
                "span": {
                  "start": 58,
                  "end": 66,
                  "start_line": 2,
                  "start_col": 52
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
                "start": 58,
                "end": 69,
                "start_line": 2,
                "start_col": 52
              }
            },
            {
              "name": "f",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "object"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 71,
                      "end": 77,
                      "start_line": 2,
                      "start_col": 65
                    }
                  }
                },
                "span": {
                  "start": 71,
                  "end": 77,
                  "start_line": 2,
                  "start_col": 65
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
                "start": 71,
                "end": 80,
                "start_line": 2,
                "start_col": 65
              }
            },
            {
              "name": "g",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "mixed"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 82,
                      "end": 87,
                      "start_line": 2,
                      "start_col": 76
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 87,
                  "start_line": 2,
                  "start_col": 76
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
                "start": 82,
                "end": 90,
                "start_line": 2,
                "start_col": 76
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
                  "start": 94,
                  "end": 98,
                  "start_line": 2,
                  "start_col": 88
                }
              }
            },
            "span": {
              "start": 94,
              "end": 98,
              "start_line": 2,
              "start_col": 88
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 101,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 101,
    "start_line": 1,
    "start_col": 0
  }
}
