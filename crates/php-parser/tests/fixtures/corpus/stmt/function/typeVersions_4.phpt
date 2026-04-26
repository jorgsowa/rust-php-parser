===config===
min_php=8.2
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
                      "end": 29
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 29
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
                "end": 33
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
                      "end": 38
                    }
                  }
                },
                "span": {
                  "start": 35,
                  "end": 38
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
                "end": 42
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
                      "end": 49
                    }
                  }
                },
                "span": {
                  "start": 44,
                  "end": 49
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
                "end": 53
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
                      "end": 61
                    }
                  }
                },
                "span": {
                  "start": 55,
                  "end": 61
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
                "end": 65
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
                      "end": 90
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 90
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
                "end": 94
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
                      "end": 117
                    }
                  }
                },
                "span": {
                  "start": 111,
                  "end": 117
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
                "end": 121
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
                      "end": 143
                    }
                  }
                },
                "span": {
                  "start": 138,
                  "end": 143
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
                "end": 147
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
                      "end": 168
                    }
                  }
                },
                "span": {
                  "start": 164,
                  "end": 168
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
                "end": 172
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
                      "end": 194
                    }
                  }
                },
                "span": {
                  "start": 189,
                  "end": 194
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
                "end": 198
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
                  "end": 218
                }
              }
            },
            "span": {
              "start": 214,
              "end": 218
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 221
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
                  "end": 256
                }
              }
            },
            "span": {
              "start": 251,
              "end": 256
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 233,
        "end": 259
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 259
  }
}
