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
          "name": {
            "name": "process",
            "span": {
              "start": 15,
              "end": 22
            }
          },
          "params": [
            {
              "name": {
                "name": "name",
                "span": {
                  "start": 31,
                  "end": 36
                }
              },
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
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 30
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 30
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 23,
                "end": 36
              }
            },
            {
              "name": {
                "name": "count",
                "span": {
                  "start": 43,
                  "end": 49
                }
              },
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
                          "end": 42
                        }
                      }
                    },
                    "span": {
                      "start": 39,
                      "end": 42
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 42
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 38,
                "end": 49
              }
            },
            {
              "name": {
                "name": "items",
                "span": {
                  "start": 58,
                  "end": 64
                }
              },
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
                          "end": 57
                        }
                      }
                    },
                    "span": {
                      "start": 52,
                      "end": 57
                    }
                  }
                },
                "span": {
                  "start": 51,
                  "end": 57
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 51,
                "end": 64
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
                    "end": 90
                  }
                }
              },
              "span": {
                "start": 79,
                "end": 91
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
                      "end": 72
                    }
                  }
                },
                "span": {
                  "start": 68,
                  "end": 72
                }
              }
            },
            "span": {
              "start": 67,
              "end": 72
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 93
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93
  }
}
