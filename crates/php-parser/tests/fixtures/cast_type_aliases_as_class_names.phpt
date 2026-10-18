===source===
<?php function f(integer $a, ?double $b, boolean|int $c): Integer {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [
            {
              "name": "a",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "integer"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 17,
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
                "start": 17,
                "end": 27
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "double"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 30,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 36
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 36
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
                "end": 39
              }
            },
            {
              "name": "c",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "boolean"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 41,
                            "end": 48
                          }
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 48
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 49,
                            "end": 52
                          }
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 52
                      }
                    }
                  ]
                },
                "span": {
                  "start": 41,
                  "end": 52
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
                "start": 41,
                "end": 55
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "Integer"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 58,
                  "end": 65
                }
              }
            },
            "span": {
              "start": 58,
              "end": 65
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
