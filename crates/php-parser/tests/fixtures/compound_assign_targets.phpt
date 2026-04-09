===source===
<?php $arr[0] += 5; $obj->count -= 1; $data['key'] .= 'suffix';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "arr"
                      },
                      "span": {
                        "start": 6,
                        "end": 10,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 11,
                        "end": 12,
                        "start_line": 1,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Plus",
              "value": {
                "kind": {
                  "Int": 5
                },
                "span": {
                  "start": 17,
                  "end": 18,
                  "start_line": 1,
                  "start_col": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 20,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 20
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "count"
                      },
                      "span": {
                        "start": 26,
                        "end": 31,
                        "start_line": 1,
                        "start_col": 26
                      }
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 31,
                  "start_line": 1,
                  "start_col": 20
                }
              },
              "op": "Minus",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 35,
                  "end": 36,
                  "start_line": 1,
                  "start_col": 35
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 36,
            "start_line": 1,
            "start_col": 20
          }
        }
      },
      "span": {
        "start": 20,
        "end": 38,
        "start_line": 1,
        "start_col": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "data"
                      },
                      "span": {
                        "start": 38,
                        "end": 43,
                        "start_line": 1,
                        "start_col": 38
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "key"
                      },
                      "span": {
                        "start": 44,
                        "end": 49,
                        "start_line": 1,
                        "start_col": 44
                      }
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 51,
                  "start_line": 1,
                  "start_col": 38
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "String": "suffix"
                },
                "span": {
                  "start": 54,
                  "end": 62,
                  "start_line": 1,
                  "start_col": 54
                }
              }
            }
          },
          "span": {
            "start": 38,
            "end": 62,
            "start_line": 1,
            "start_col": 38
          }
        }
      },
      "span": {
        "start": 38,
        "end": 63,
        "start_line": 1,
        "start_col": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
