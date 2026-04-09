===source===
<?php
function test(
    bool $a1, int $a2, float $a3, string $a4, // PHP 7.0
    iterable $a5, // PHP 7.1
    object $a6, // PHP 7.2
    mixed $a7, // PHP 8.0
    null $a8, // PHP 8.0
    false $a9, // PHP 8.0
): void {} // PHP 7.1
function test2(): never {} // PHP 8.1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [
            {
              "name": "a1",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "bool"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 25,
                      "end": 29,
                      "start_line": 3,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 29,
                  "start_line": 3,
                  "start_col": 4
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
                "start": 25,
                "end": 33,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "name": "a2",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 35,
                      "end": 38,
                      "start_line": 3,
                      "start_col": 14
                    }
                  }
                },
                "span": {
                  "start": 35,
                  "end": 38,
                  "start_line": 3,
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
                "start": 35,
                "end": 42,
                "start_line": 3,
                "start_col": 14
              }
            },
            {
              "name": "a3",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "float"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 44,
                      "end": 49,
                      "start_line": 3,
                      "start_col": 23
                    }
                  }
                },
                "span": {
                  "start": 44,
                  "end": 49,
                  "start_line": 3,
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
                "start": 44,
                "end": 53,
                "start_line": 3,
                "start_col": 23
              }
            },
            {
              "name": "a4",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 55,
                      "end": 61,
                      "start_line": 3,
                      "start_col": 34
                    }
                  }
                },
                "span": {
                  "start": 55,
                  "end": 61,
                  "start_line": 3,
                  "start_col": 34
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
                "start": 55,
                "end": 65,
                "start_line": 3,
                "start_col": 34
              }
            },
            {
              "name": "a5",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "iterable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 82,
                      "end": 90,
                      "start_line": 4,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 90,
                  "start_line": 4,
                  "start_col": 4
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
                "end": 94,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "name": "a6",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "object"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 111,
                      "end": 117,
                      "start_line": 5,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 111,
                  "end": 117,
                  "start_line": 5,
                  "start_col": 4
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
                "start": 111,
                "end": 121,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "name": "a7",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "mixed"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 138,
                      "end": 143,
                      "start_line": 6,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 138,
                  "end": 143,
                  "start_line": 6,
                  "start_col": 4
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
                "start": 138,
                "end": 147,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "name": "a8",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "null"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 164,
                      "end": 168,
                      "start_line": 7,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 164,
                  "end": 168,
                  "start_line": 7,
                  "start_col": 4
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
                "start": 164,
                "end": 172,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "name": "a9",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "false"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 189,
                      "end": 194,
                      "start_line": 8,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 189,
                  "end": 194,
                  "start_line": 8,
                  "start_col": 4
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
                "start": 189,
                "end": 198,
                "start_line": 8,
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
                  "start": 214,
                  "end": 218,
                  "start_line": 9,
                  "start_col": 3
                }
              }
            },
            "span": {
              "start": 214,
              "end": 218,
              "start_line": 9,
              "start_col": 3
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 221,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test2",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 251,
                  "end": 256,
                  "start_line": 10,
                  "start_col": 18
                }
              }
            },
            "span": {
              "start": 251,
              "end": 256,
              "start_line": 10,
              "start_col": 18
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 233,
        "end": 259,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 259,
    "start_line": 1,
    "start_col": 0
  }
}
