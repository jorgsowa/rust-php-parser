===source===
<?php
function &getValue(): string {
    return $GLOBALS['value'];
}
function &getReference(array &$arr): mixed {
    return $arr[0];
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "getValue",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "GLOBALS"
                        },
                        "span": {
                          "start": 48,
                          "end": 56,
                          "start_line": 3,
                          "start_col": 11
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "value"
                        },
                        "span": {
                          "start": 57,
                          "end": 64,
                          "start_line": 3,
                          "start_col": 20
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 48,
                    "end": 65,
                    "start_line": 3,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 41,
                "end": 67,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "string"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 28,
                  "end": 34,
                  "start_line": 2,
                  "start_col": 22
                }
              }
            },
            "span": {
              "start": 28,
              "end": 34,
              "start_line": 2,
              "start_col": 22
            }
          },
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "getReference",
          "params": [
            {
              "name": "arr",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 92,
                      "end": 97,
                      "start_line": 5,
                      "start_col": 23
                    }
                  }
                },
                "span": {
                  "start": 92,
                  "end": 97,
                  "start_line": 5,
                  "start_col": 23
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 92,
                "end": 103,
                "start_line": 5,
                "start_col": 23
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "arr"
                        },
                        "span": {
                          "start": 125,
                          "end": 129,
                          "start_line": 6,
                          "start_col": 11
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 130,
                          "end": 131,
                          "start_line": 6,
                          "start_col": 16
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 125,
                    "end": 132,
                    "start_line": 6,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 118,
                "end": 134,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "mixed"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 106,
                  "end": 111,
                  "start_line": 5,
                  "start_col": 37
                }
              }
            },
            "span": {
              "start": 106,
              "end": 111,
              "start_line": 5,
              "start_col": 37
            }
          },
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 69,
        "end": 135,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 135,
    "start_line": 1,
    "start_col": 0
  }
}
