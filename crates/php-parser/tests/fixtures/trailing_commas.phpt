===source===
<?php
$arr = [1, 2, 3,];
foo($a, $b, $c,);
function bar($x, $y,) {}
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
                  "Variable": "arr"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 14,
                          "end": 15,
                          "start_line": 2,
                          "start_col": 8
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 14,
                        "end": 15,
                        "start_line": 2,
                        "start_col": 8
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 17,
                          "end": 18,
                          "start_line": 2,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 17,
                        "end": 18,
                        "start_line": 2,
                        "start_col": 11
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 20,
                          "end": 21,
                          "start_line": 2,
                          "start_col": 14
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 20,
                        "end": 21,
                        "start_line": 2,
                        "start_col": 14
                      }
                    }
                  ]
                },
                "span": {
                  "start": 13,
                  "end": 23,
                  "start_line": 2,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 25,
                  "end": 28,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 29,
                      "end": 31,
                      "start_line": 3,
                      "start_col": 4
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 29,
                    "end": 31,
                    "start_line": 3,
                    "start_col": 4
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 33,
                      "end": 35,
                      "start_line": 3,
                      "start_col": 8
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 33,
                    "end": 35,
                    "start_line": 3,
                    "start_col": 8
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 37,
                      "end": 39,
                      "start_line": 3,
                      "start_col": 12
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 37,
                    "end": 39,
                    "start_line": 3,
                    "start_col": 12
                  }
                }
              ]
            }
          },
          "span": {
            "start": 25,
            "end": 41,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 43,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "bar",
          "params": [
            {
              "name": "x",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 56,
                "end": 58,
                "start_line": 4,
                "start_col": 13
              }
            },
            {
              "name": "y",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 60,
                "end": 62,
                "start_line": 4,
                "start_col": 17
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
        "start": 43,
        "end": 67,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67,
    "start_line": 1,
    "start_col": 0
  }
}
