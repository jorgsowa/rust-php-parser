===source===
<?php
function foo($a, $b,) {}
foo(1, 2,);
$f = function($x,) use ($y,) {};
$g = fn($x,) => $x;
[$a, $b,] = $arr;
match ($x) { 1 => 'a', 2 => 'b', };
use App\{A, B,};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "a",
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
                "start": 19,
                "end": 21,
                "start_line": 2,
                "start_col": 13
              }
            },
            {
              "name": "b",
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
                "start": 23,
                "end": 25,
                "start_line": 2,
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
        "start": 6,
        "end": 30,
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
                  "start": 31,
                  "end": 34,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 35,
                      "end": 36,
                      "start_line": 3,
                      "start_col": 4
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 35,
                    "end": 36,
                    "start_line": 3,
                    "start_col": 4
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 38,
                      "end": 39,
                      "start_line": 3,
                      "start_col": 7
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 38,
                    "end": 39,
                    "start_line": 3,
                    "start_col": 7
                  }
                }
              ]
            }
          },
          "span": {
            "start": 31,
            "end": 41,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 31,
        "end": 43,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 43,
                  "end": 45,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
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
                          "start": 57,
                          "end": 59,
                          "start_line": 4,
                          "start_col": 14
                        }
                      }
                    ],
                    "use_vars": [
                      {
                        "name": "y",
                        "by_ref": false,
                        "span": {
                          "start": 67,
                          "end": 69,
                          "start_line": 4,
                          "start_col": 24
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 48,
                  "end": 74,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 74,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 43,
        "end": 76,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 76,
                  "end": 78,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
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
                          "start": 84,
                          "end": 86,
                          "start_line": 5,
                          "start_col": 8
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 92,
                        "end": 94,
                        "start_line": 5,
                        "start_col": 16
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 81,
                  "end": 94,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 76,
            "end": 94,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 76,
        "end": 96,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 97,
                          "end": 99,
                          "start_line": 6,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 97,
                        "end": 99,
                        "start_line": 6,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 101,
                          "end": 103,
                          "start_line": 6,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 101,
                        "end": 103,
                        "start_line": 6,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 96,
                  "end": 105,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 108,
                  "end": 112,
                  "start_line": 6,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 96,
            "end": 112,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 96,
        "end": 114,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 121,
                  "end": 123,
                  "start_line": 7,
                  "start_col": 7
                }
              },
              "arms": [
                {
                  "conditions": [
                    {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 127,
                        "end": 128,
                        "start_line": 7,
                        "start_col": 13
                      }
                    }
                  ],
                  "body": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 132,
                      "end": 135,
                      "start_line": 7,
                      "start_col": 18
                    }
                  },
                  "span": {
                    "start": 127,
                    "end": 135,
                    "start_line": 7,
                    "start_col": 13
                  }
                },
                {
                  "conditions": [
                    {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 137,
                        "end": 138,
                        "start_line": 7,
                        "start_col": 23
                      }
                    }
                  ],
                  "body": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 142,
                      "end": 145,
                      "start_line": 7,
                      "start_col": 28
                    }
                  },
                  "span": {
                    "start": 137,
                    "end": 145,
                    "start_line": 7,
                    "start_col": 23
                  }
                }
              ]
            }
          },
          "span": {
            "start": 114,
            "end": 148,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 114,
        "end": 150,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "App",
                  "A"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 154,
                  "end": 160,
                  "start_line": 8,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 159,
                "end": 160,
                "start_line": 8,
                "start_col": 9
              }
            },
            {
              "name": {
                "parts": [
                  "App",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 154,
                  "end": 163,
                  "start_line": 8,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 162,
                "end": 163,
                "start_line": 8,
                "start_col": 12
              }
            }
          ]
        }
      },
      "span": {
        "start": 150,
        "end": 166,
        "start_line": 8,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 166,
    "start_line": 1,
    "start_col": 0
  }
}
