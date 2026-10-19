===source===
<?php
function f(?bool\X $a, array\Y|null $b, iterable\Z|callable\W $c) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
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
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "bool",
                          "X"
                        ],
                        "kind": "Qualified",
                        "span": {
                          "start": 18,
                          "end": 24
                        }
                      }
                    },
                    "span": {
                      "start": 18,
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
              "attributes": [],
              "span": {
                "start": 17,
                "end": 27
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 42,
                  "end": 44
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "array",
                            "Y"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 29,
                            "end": 36
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 36
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "null"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 37,
                            "end": 41
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 41
                      }
                    }
                  ]
                },
                "span": {
                  "start": 29,
                  "end": 41
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 29,
                "end": 44
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 68,
                  "end": 70
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "iterable",
                            "Z"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 46,
                            "end": 56
                          }
                        }
                      },
                      "span": {
                        "start": 46,
                        "end": 56
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "callable",
                            "W"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 57,
                            "end": 67
                          }
                        }
                      },
                      "span": {
                        "start": 57,
                        "end": 67
                      }
                    }
                  ]
                },
                "span": {
                  "start": 46,
                  "end": 67
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 46,
                "end": 70
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 74
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74
  }
}
