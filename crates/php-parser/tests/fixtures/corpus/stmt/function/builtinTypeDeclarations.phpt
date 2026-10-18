===source===
<?php
function test(bool $a, Int $b, FLOAT $c, StRiNg $d, iterable $e, object $f, mixed $g) : void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 25,
                  "end": 27
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "bool"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 20,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 24
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
                "end": 27
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 33,
                  "end": 35
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 29,
                      "end": 32
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 32
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
                "end": 35
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 43,
                  "end": 45
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "float"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 37,
                      "end": 42
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 42
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
                "end": 45
              }
            },
            {
              "name": {
                "name": "d",
                "span": {
                  "start": 54,
                  "end": 56
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 47,
                      "end": 53
                    }
                  }
                },
                "span": {
                  "start": 47,
                  "end": 53
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
                "end": 56
              }
            },
            {
              "name": {
                "name": "e",
                "span": {
                  "start": 67,
                  "end": 69
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "iterable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 58,
                      "end": 66
                    }
                  }
                },
                "span": {
                  "start": 58,
                  "end": 66
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
                "end": 69
              }
            },
            {
              "name": {
                "name": "f",
                "span": {
                  "start": 78,
                  "end": 80
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "object"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 71,
                      "end": 77
                    }
                  }
                },
                "span": {
                  "start": 71,
                  "end": 77
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
                "end": 80
              }
            },
            {
              "name": {
                "name": "g",
                "span": {
                  "start": 88,
                  "end": 90
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "mixed"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 82,
                      "end": 87
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 87
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
                "end": 90
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
                  "end": 98
                }
              }
            },
            "span": {
              "start": 94,
              "end": 98
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 101
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 101
  }
}
